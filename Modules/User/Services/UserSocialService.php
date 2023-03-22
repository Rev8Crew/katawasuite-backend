<?php

declare(strict_types=1);

namespace Modules\User\Services;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Modules\User\Entities\DTO\RegisterSocialDto;
use Modules\User\Entities\User;
use Modules\User\Entities\UserSocial;
use Modules\User\Enums\AuthProviderEnum;

class UserSocialService implements UserSocialServiceInterface
{
    public function canUseNameAttribute(AuthProviderEnum $authProvider): bool
    {
        foreach (AuthProviderEnum::withNameAttribute() as $provider) {
            if ($provider->value === $authProvider->value) {
                return true;
            }
        }

        return false;
    }

    public function getSocialsByUser(User $user): EloquentCollection
    {
        return UserSocial::whereUserId($user->id)->get();
    }

    public function findByProvider(AuthProviderEnum $provider, string $providerUserId): ?UserSocial
    {
        return UserSocial::query()
            ->where([
                'provider' => $provider->value,
                'provider_id' => $providerUserId,
            ])
            ->first();
    }

    public function create(RegisterSocialDto $dto): UserSocial
    {
        return UserSocial::create($dto->toArray());
    }

    public function changeAvatar(UserSocial $userSocial, string $avatar): bool
    {
        return $userSocial->fill(['avatar' => $avatar])->save();
    }
}
