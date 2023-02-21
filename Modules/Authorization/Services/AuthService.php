<?php
declare(strict_types=1);

namespace Modules\Authorization\Services;

use Laravel\Socialite\Two\User as SocialiteUser;
use Modules\User\Entities\User;
use Modules\User\Enums\AuthProviderEnum;

class AuthService implements AuthServiceInterface
{

    public function sendActivationEmail(User $user, string $token): void
    {
        // TODO: Implement sendActivationEmail() method.
    }

    public function sendResetPasswordEmail(User $user, string $token): void
    {
        // TODO: Implement sendResetPasswordEmail() method.
    }

    public function changeEmail(User $user, string $email)
    {
        // TODO: Implement changeEmail() method.
    }

    public function changeName(User $user, string $name): bool
    {
        // TODO: Implement changeName() method.
    }

    public function changePassword(User $user, string $old, string $new): bool
    {
        // TODO: Implement changePassword() method.
    }

    public function socialAuth(SocialiteUser $socialiteUser, AuthProviderEnum $provider): User
    {
    }
}
