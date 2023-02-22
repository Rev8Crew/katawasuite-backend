<?php

namespace Modules\Authorization\Http\Controllers;

use App\Enums\ActiveStatusEnum;
use App\Models\Common\Response;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Authorization\Http\Requests\LoginRequest;
use Modules\User\Entities\User;
use Modules\User\Http\Resources\UserResource;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class AuthorizationController extends Controller
{
    public function login(LoginRequest $request): Response
    {
        $response = new Response();

        $user = User::whereEmail($request->input('email'))->first();
        if ($user && $user->is_active !== ActiveStatusEnum::Active->value) {
            return $response->withError(SymfonyResponse::HTTP_BAD_REQUEST, trans('authorization.active'));
        }

        if (!auth()->attempt($request->only('email', 'password'))) {
            return $response->withError(SymfonyResponse::HTTP_BAD_REQUEST, trans('authorization.failed'));
        }

        /**
         * @var User $user
         */
        $user = $request->user();
        $token = $user->createToken('web');

        $resource = new UserResource($user);
        $resource->setToken($token->plainTextToken);

        return $response->withData($resource);
    }

    public function me(): Response {
        $response = new Response();

        $user = request()->user();
        //$user->load(['notifications']);

        $resource = UserResource::make($user);

        return $response->withData($resource);
    }
}
