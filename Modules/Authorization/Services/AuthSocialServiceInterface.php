<?php
declare(strict_types=1);

namespace Modules\Authorization\Services;

use App\Models\User;
use Illuminate\Support\Collection;
use \Illuminate\Database\Eloquent\Collection as EloquentCollection;

interface AuthSocialServiceInterface
{

    public function getProvidersThatUseNameAttribute(): Collection;

    public function getSocialsByUser(User $user): EloquentCollection;
}
