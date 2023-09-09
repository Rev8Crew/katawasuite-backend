<?php

declare(strict_types=1);

namespace Modules\User\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Mail;
use Modules\Authorization\Mail\ChangePasswordMail;
use Modules\User\Entities\DTO\RegisterDto;
use Modules\User\Entities\User;
use RuntimeException;

class UserService implements UserServiceInterface
{
    public function create(RegisterDto $dto): User
    {
        $array = [
            'name' => $dto->getName(),
            'email' => $dto->getEmail(),
        ];

        if ($dto->status) {
            $array['is_active'] = $dto->status->value;
        }

        if ($dto->phone) {
            $array['phone'] = $dto->getPhone();
        }

        if ($dto->password) {
            $array['password'] = Hash::make($dto->getPassword());
        }

        if ($dto->verified === true) {
            $array['email_verified_at'] = Carbon::now();
        }

        return User::create($array);
    }

    public function changePassword(User $user, string $password): bool
    {
        $user->password = Hash::make($password);
        Mail::send(new ChangePasswordMail($user));

        return $user->save();
    }

    public function getUserByEmail(string $email): ?User
    {
        return User::whereEmail($email)->first();
    }

    public function changeEmail(User $user, string $email): ?bool
    {
        if ($user->email === $email) {
            return true;
        }

        if ($this->getUserByEmail($email)) {
            return false;
        }

        $user->fill(['email' => $email, 'email_verified_at' => null])->save();

        return true;
    }

    public function changeName(User $user, string $name): bool
    {
        if ($user->name === $name) {
            return false;
        }

        $user->update(['name' => $name]);

        return true;
    }

    public function changePhone(User $user, string $phone): bool
    {
        throw_if($user->phone === $phone, new RuntimeException(trans('user::user.samePhone')));
        throw_if(! phone($phone, ['RU', 'UA', 'KZ'])->isValid(), new RuntimeException(trans('user::user.localPhone')));
        throw_if(User::where('phone', '=', $phone)->exists(), new RuntimeException(trans('user::user.repeatedNumber')));

        return $user->update(['phone' => $phone]);
    }
}
