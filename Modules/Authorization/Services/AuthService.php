<?php
declare(strict_types=1);

namespace Modules\Authorization\Services;

use App\Enums\EnviromentEnum;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Two\User as SocialiteUser;
use Modules\Authorization\Mail\ActivationEmailMail;
use Modules\User\Entities\User;
use Modules\User\Enums\AuthProviderEnum;
use Modules\User\Services\UserServiceInterface;

class AuthService implements AuthServiceInterface
{
    public function __construct(
        private UserServiceInterface $userService,
        private AuthSocialServiceInterface $socialService
    ) {}

    public function sendActivationEmail(User $user, string $token): void
    {
        $driver = app()->environment('production') ? Mail::getDefaultDriver() : 'log';
        Mail::mailer($driver)->send(new ActivationEmailMail($user, $token));
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
