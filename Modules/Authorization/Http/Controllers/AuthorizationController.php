<?php

namespace Modules\Authorization\Http\Controllers;

use App\Enums\ActiveStatusEnum;
use App\Models\Common\Response;
use Carbon\Carbon;
use Crypt;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Modules\Authorization\Http\Requests\ChangeCredentialsRequest;
use Modules\Authorization\Http\Requests\ChangePasswordRequest;
use Modules\Authorization\Http\Requests\LoginRequest;
use Modules\Authorization\Http\Requests\RegisterRequest;
use Modules\Authorization\Http\Requests\ResetPasswordRequest;
use Modules\Authorization\Services\AuthServiceInterface;
use Modules\User\Entities\DTO\RegisterDto;
use Modules\User\Entities\User;
use Modules\User\Enums\AuthProviderEnum;
use Modules\User\Http\Resources\UserResource;
use Modules\User\Services\UserServiceInterface;
use Socialite;
use Str;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Throwable;

class AuthorizationController extends \App\Http\Controllers\Controller
{
    public function __construct(
        private readonly AuthServiceInterface $authService,
        private readonly UserServiceInterface $userService
    ) {
    }

    public function register(RegisterRequest $request): Response
    {
        $response = Response::make();

        try {
            $user = $this->userService->create(new RegisterDto(
                $request->input('name'),
                $request->input('email'),
                $request->input('password'),
                $request->input('phone')
            ));

            $this->authService->sendActivationEmail($user, Crypt::encryptString($user->email));
        } catch (\Exception $throwable) {
            return $response->catch($throwable);
        }

        return $response->success();
    }

    public function login(LoginRequest $request): Response
    {
        $response = Response::make();

        $user = $this->userService->getUserByEmail($request->input('email'));
        if ($user && $user->is_active !== ActiveStatusEnum::Active->value) {
            return $response->withError(SymfonyResponse::HTTP_BAD_REQUEST, trans('authorization::authorization.active'));
        }

        if (! auth()->attempt($request->only('email', 'password'))) {
            return $response->withError(SymfonyResponse::HTTP_BAD_REQUEST, trans('authorization::authorization.failed'));
        }

        /**
         * @var User $user
         */
        $user = $request->user();
        $token = $user->createToken('web');

        $resource = UserResource::make($user);
        $resource->setToken($token->plainTextToken);

        return $response->withData($resource);
    }

    public function logout(): Response
    {
        $response = Response::make();
        $user = request()->user();

        if ($user) {
            $user->tokens()->delete();
        }

        Auth::logout();

        return $response->success();
    }

    public function verify(string $token)
    {
        $email = Crypt::decryptString($token);
        $user = $this->userService->getUserByEmail($email);

        if (! $user || $user->email_verified_at) {
            abort(SymfonyResponse::HTTP_BAD_REQUEST);
        }

        $user->fill(['is_active' => ActiveStatusEnum::Active->value, 'email_verified_at' => Carbon::now()]);
        $user->save();

        return view('authorization::verify_acc');
    }

    public function me(): Response
    {
        $response = Response::make();

        $user = request()->user();
        $user->load(['notifications']);

        $resource = UserResource::make($user);

        return $response->withData($resource);
    }

    public function changeCredentials(ChangeCredentialsRequest $request): Response
    {
        $response = Response::make();
        $user = $request->user();

        $isEmailChanged = $this->userService->changeEmail($user, $request->input('email'));
        if ($isEmailChanged === false) {
            return $response->withError(SymfonyResponse::HTTP_UNPROCESSABLE_ENTITY, trans('authorization::authorization.emailAlreadyExist'));
        }

        if ($isEmailChanged === true) {
            try {
                $this->authService->sendActivationEmail($user, Crypt::encryptString($user->email));
            } catch (Throwable $ex) {
                return $response->catch($ex);
            }
        }

        $this->userService->changeName($user, $request->input('name'));

        return $response->success();
    }

    public function changePassword(ChangePasswordRequest $request): Response
    {
        $response = Response::make();
        $user = $request->user();

        if (! $this->userService->changePassword($user, $request->input('new_password'))) {
            return $response->withError(SymfonyResponse::HTTP_UNPROCESSABLE_ENTITY, trans('auth.oldPasswordConfirmation'));
        }

        return $response->success();
    }

    public function resetPassword(ResetPasswordRequest $request): Response
    {
        $response = Response::make();
        $email = $request->input('email');

        try {
            $this->authService->sendResetPasswordEmail($this->userService->getUserByEmail($email), Crypt::encryptString($email));
        } catch (Throwable $ex) {
            return $response->catch($ex);
        }

        return $response->success();
    }

    public function resetPasswordView(string $token)
    {
        $email = Crypt::decryptString($token);

        if (! ($user = $this->userService->getUserByEmail($email))) {
            abort(SymfonyResponse::HTTP_BAD_REQUEST);
        }

        if (\request()->post()) {
            $this->validate(\request(), [
                'password' => get_password_rules(),
            ]);

            $this->userService->changePassword($user, request()->post('password'));

            return view('authorization::reset_password_success');
        }

        return view('authorization::reset_password', compact('token'));
    }

    public function reSendActivationEmail(ResetPasswordRequest $request): Response
    {
        $response = Response::make();

        $user = $this->userService->getUserByEmail($request->input('email'));

        if ($user && $user->email_verified_at === null) {
            try {
                $this->authService->sendActivationEmail($user, Crypt::encryptString($user->email));
            } catch (Throwable $ex) {
                return $response->catch($ex);
            }
        }

        return $response->success();
    }

    public function providers(): Response
    {
        return Response::make()->withData(AuthProviderEnum::labels());
    }

    public function redirect(string $provider)
    {
        $authProvider = AuthProviderEnum::tryFrom($provider);

        if (! $authProvider) {
            abort(SymfonyResponse::HTTP_NOT_FOUND);
        }

        return \Socialite::driver($authProvider->value)->redirect();
    }

    public function callback(string $provider): RedirectResponse
    {
        $authProvider = AuthProviderEnum::tryFrom($provider);

        if (! $authProvider) {
            abort(SymfonyResponse::HTTP_NOT_FOUND);
        }

        /** @var \Laravel\Socialite\Two\User $authUser */
        $authUser = Socialite::driver($authProvider->value)->user();

        if (! ($authUser instanceof \Laravel\Socialite\Two\User)) {
            abort(SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR, trans('authorization::authorization.oauth_v2'));
        }

        if (Str::of($authUser->getEmail())->isEmpty()) {
            abort(SymfonyResponse::HTTP_UNPROCESSABLE_ENTITY, trans('authorization::authorization.oauth_empty_email'));
        }

        $token = $this->authService->socialAuth($authUser, $authProvider)->createToken('web');

        return redirect()->to('app/auth/signin?'.http_build_query(['redirect' => '/home', 'social' => $token->plainTextToken]));
    }
}
