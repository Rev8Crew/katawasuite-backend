<?php
declare(strict_types=1);

namespace Modules\User\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Modules\User\Entities\DTO\RegisterSocialDto;
use Modules\User\Entities\UserSocial;
use Modules\User\Enums\AuthProviderEnum;

interface UserSocialServiceInterface
{
    public function canUseNameAttribute(AuthProviderEnum $authProvider): bool;

    public function getSocialsByUser(User $user): EloquentCollection;

    public function findByProvider(AuthProviderEnum $provider, int $providerUserId): ?UserSocial;

    public function create(RegisterSocialDto $dto): UserSocial;
}
