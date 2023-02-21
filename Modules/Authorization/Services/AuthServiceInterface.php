<?php
declare(strict_types=1);

namespace Modules\Authorization\Services;

use Exception;
use Modules\User\Entities\User;
use Laravel\Socialite\Two\User as SocialiteUser;
use Modules\User\Enums\AuthProviderEnum;

interface AuthServiceInterface
{
    /**
     * @throws Exception
     */
    public function sendActivationEmail(User $user, string $token): void;

    /**
     * @throws Exception
     */
    public function sendResetPasswordEmail(User $user, string $token): void;

    public function changeEmail(User $user, string $email);

    public function changeName(User $user, string $name): bool;

    public function changePassword(User $user, string $old, string $new): bool;

    public function socialAuth(SocialiteUser $socialiteUser, AuthProviderEnum $provider): User;
}
