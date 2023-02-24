<?php

declare(strict_types=1);

namespace Modules\Game\Services;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Modules\Game\Entities\Game;
use Modules\User\Entities\User;
use Modules\User\Entities\UserGameSave;

class GameService implements GameServiceInterface
{
    public function getAllGames(): Collection
    {
        return Game::active()->get();
    }

    public function getGameByShort(string $short): Game
    {
        return Game::whereShort($short)->active()->firstOrFail();
    }

    public function getUserSavesByGame(User $user, Game $game): Collection
    {
        return UserGameSave::whereGameId($game->id)->whereUserId($user->id)->orderBy('slot')->get();
    }

    public function saveGameDataByUser($data, Game $game, User $user): void
    {
        $saves = collect(json_decode($data, true, 512, JSON_THROW_ON_ERROR));

        $saves = $saves->map(function ($item) use ($game, $user) {
            return [
                'data' => json_encode($item['data'], JSON_UNESCAPED_UNICODE),
                'slot' => $item['_slot'],
                'user_id' => $user->id,
                'game_id' => $game->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        });

        UserGameSave::where('game_id', $game->id)->where('user_id', $user->id)->delete();
        UserGameSave::insert($saves->toArray());
    }
}
