<?php
declare(strict_types=1);

namespace Modules\User\Services;

use Modules\User\Entities\DTO\RegisterDto;
use Modules\User\Entities\User;

interface UserServiceInterface
{
    public function create(RegisterDto $dto): User;

    public function getUserByEmail(string $email): ?User;

    public function changeEmail(User $user, string $email): bool;

    public function changeName(User $user, string $name): bool;

    public function changePassword(User $user, string $password): bool;
}
