<?php

declare(strict_types=1);

namespace Modules\User\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Game\Entities\Game;
use Modules\User\Entities\UserFavoriteGames;
use Modules\User\Http\Resources\UserFavoritesGameResource;

class UserFavoriteGamesService implements UserFavoriteGamesServiceInterface
{
    public function addGameToUserFavorites(Game $game, User $user): AnonymousResourceCollection
    {
        UserFavoriteGames::firstOrCreate([
            'user_id' => $user->id,
            'game_id' => $game->id,
        ]);

        return $this->getListOfUserFavorites($user);
    }

    public function removeGameFromUserFavorites(Game $game, User $user): AnonymousResourceCollection
    {
        UserFavoriteGames::where([
            'user_id' => $user->id,
            'game_id' => $game->id,
        ])->delete();

        return $this->getListOfUserFavorites($user);
    }

    public function getListOfUserFavorites(User $user, int $limit = 5): AnonymousResourceCollection
    {
        $collection = UserFavoriteGames::whereUserId($user->id)->whereHas('game', fn (Builder $query) => $query->active())->limit($limit)->get();
        $collection->load(['game', 'game.imageFile']);

        return UserFavoritesGameResource::collection($collection);
    }
}
