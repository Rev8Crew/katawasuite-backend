<?php

declare(strict_types=1);

namespace Modules\User\Services;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Modules\User\Entities\DTO\RegisterSocialDto;
use Modules\User\Entities\User;
use Modules\User\Entities\UserSocial;
use Modules\User\Enums\AuthProviderEnum;

interface UserSocialServiceInterface
{
    public function canUseNameAttribute(AuthProviderEnum $authProvider): bool;

    public function getSocialsByUser(User $user): EloquentCollection;

    public function findByProvider(AuthProviderEnum $provider, int $providerUserId): ?UserSocial;

    public function create(RegisterSocialDto $dto): UserSocial;

    public function changeAvatar(UserSocial $userSocial, string $avatar): bool;
}
