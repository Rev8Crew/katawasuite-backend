<?php

declare(strict_types=1);

namespace Modules\Authorization\Services;

use Exception;
use Laravel\Socialite\Two\User as SocialiteUser;
use Modules\User\Entities\User;
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

    public function socialAuth(SocialiteUser $socialiteUser, AuthProviderEnum $provider): User;
}
