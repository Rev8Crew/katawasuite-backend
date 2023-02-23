<?php
declare(strict_types=1);

namespace Modules\User\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Modules\User\Entities\DTO\RegisterDto;
use Modules\User\Entities\User;

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
        $user->password =Hash::make($password);
        return $user->save();
    }

    public function getUserByEmail(string $email): ?User
    {
        return User::whereEmail($email)->first();
    }

    public function changeEmail(User $user, string $email): bool|null
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
}
