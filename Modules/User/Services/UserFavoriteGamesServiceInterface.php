<?php

declare(strict_types=1);

namespace Modules\User\Services;

use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Game\Entities\Game;

interface UserFavoriteGamesServiceInterface
{
    public function addGameToUserFavorites(Game $game, User $user): AnonymousResourceCollection;

    public function removeGameFromUserFavorites(Game $game, User $user): AnonymousResourceCollection;

    public function getListOfUserFavorites(User $user, int $limit = 5): AnonymousResourceCollection;
}
