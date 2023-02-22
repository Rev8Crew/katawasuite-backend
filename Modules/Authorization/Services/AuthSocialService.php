<?php
declare(strict_types=1);

namespace Modules\Authorization\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Modules\User\Entities\UserSocial;
use Modules\User\Enums\AuthProviderEnum;

class AuthSocialService implements AuthSocialServiceInterface
{

    public function getProvidersThatUseNameAttribute(): Collection
    {
        return collect(AuthProviderEnum::withNameAttribute());
    }

    public function getSocialsByUser(User $user): EloquentCollection
    {
        return UserSocial::whereUserId($user->id)->get();
    }
}
