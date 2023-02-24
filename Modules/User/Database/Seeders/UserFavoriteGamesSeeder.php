<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Game\Services\GameServiceInterface;
use Modules\User\Entities\UserFavoriteGames;
use Modules\User\Services\UserServiceInterface;

class UserFavoriteGamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(UserServiceInterface $userService, GameServiceInterface $gameService)
    {
        UserFavoriteGames::create([
            'user_id' => $userService->getUserByEmail(config('app.admin_default_email'))->id,
            'game_id' => $gameService->getGameByShort('ks')->id,
        ]);
    }
}
