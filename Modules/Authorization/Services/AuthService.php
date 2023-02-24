<?php

declare(strict_types=1);

namespace Modules\Authorization\Services;

use App\Enums\ActiveStatusEnum;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Two\User as SocialiteUser;
use Modules\Authorization\Mail\ActivationEmailMail;
use Modules\Authorization\Mail\ResetPasswordMail;
use Modules\User\Entities\DTO\RegisterDto;
use Modules\User\Entities\DTO\RegisterSocialDto;
use Modules\User\Entities\User;
use Modules\User\Enums\AuthProviderEnum;
use Modules\User\Services\UserServiceInterface;
use Modules\User\Services\UserSocialServiceInterface;

class AuthService implements AuthServiceInterface
{
    public function __construct(
        private readonly UserServiceInterface $userService,
        private readonly UserSocialServiceInterface $socialService
    ) {
    }

    public function sendActivationEmail(User $user, string $token): void
    {
        $driver = app()->environment('production') ? Mail::getDefaultDriver() : 'log';
        Mail::mailer($driver)->send(new ActivationEmailMail($user, $token));
    }

    public function sendResetPasswordEmail(User $user, string $token): void
    {
        $driver = app()->environment('production') ? Mail::getDefaultDriver() : 'log';
        Mail::mailer($driver)->send(new ResetPasswordMail($user, $token));
    }

    public function socialAuth(SocialiteUser $socialiteUser, AuthProviderEnum $provider): User
    {
        $name = $this->socialService->canUseNameAttribute($provider) || ! $socialiteUser->getNickname() ? $socialiteUser->getName() : $socialiteUser->getNickname();
        $email = $socialiteUser->getEmail();

        $existSocial = $this->socialService->findByProvider($provider, $socialiteUser->id);

        if ($existSocial === null) {
            $registerDto = new RegisterDto($name, $email, null, null, ActiveStatusEnum::Active, true);

            $existSocial = $this->socialService->create(
                new RegisterSocialDto(
                    $provider->value,
                    $socialiteUser->id,
                    $socialiteUser->getName(),
                    $socialiteUser->getAvatar(),
                    $email
                )
            );

            $user = $this->userService->getUserByEmail($email ?? '');

            if ($user === null) {
                $user = $this->userService->create($registerDto);
            }
        } else {
            if ($socialiteUser->getAvatar()) {
                $this->socialService->changeAvatar($existSocial, $socialiteUser->getAvatar());
            }

            $user = $existSocial->user;
        }

        if (false === $existSocial->exists) {
            $user->socials()->save($existSocial);
            $user->unsetRelation('socials');
        }

        \Auth::login($user);

        return $user;
    }
}
