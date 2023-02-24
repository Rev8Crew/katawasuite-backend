<?php

declare(strict_types=1);

namespace Modules\Game\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Game\Entities\Game;
use Modules\User\Entities\User;
use Modules\User\Entities\UserGameSave;

interface GameServiceInterface
{
    /**
     * @return Game[]|Collection
     */
    public function getAllGames(): Collection;

    public function getGameByShort(string $short): Game;

    /**
     * @return Collection|UserGameSave[]
     */
    public function getUserSavesByGame(User $user, Game $game): Collection;

    public function saveGameDataByUser($data, Game $game, User $user): void;
}
