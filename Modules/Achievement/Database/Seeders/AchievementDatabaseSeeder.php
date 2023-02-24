<?php

namespace Modules\Achievement\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Achievement\DTO\AchievementCreateDto;
use Modules\Achievement\Enums\RewardTypeEnum;
use Modules\Achievement\Services\AchievementServiceInterface;
use Modules\Achievement\Services\RewardServiceInterface;
use Modules\Game\Services\GameServiceInterface;
use Modules\User\Services\UserServiceInterface;

class AchievementDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(
        GameServiceInterface $gameService,
        AchievementServiceInterface $achievementService,
        RewardServiceInterface $rewardService,
        UserServiceInterface $userService
    )
    {
        Model::unguard();

        $dto =new AchievementCreateDto(
            name: 'Я новенький!',
            description: 'Завершите хотя бы один рут в оригинальном моде Katawa Shoujo',
            short: 'ks_original_start',
            gameId: $gameService->getGameByShort('ks')->id
        );

        $achievement = $achievementService->create($dto);
        $reward = $rewardService->create(
            rewardType: RewardTypeEnum::Text,
            value: "Поздравляем, это оч круто, продолжайте в том же духе",
            achievementId: $achievement->id,
        );

        $user = $userService->getUserByEmail(config('app.admin_default_email'));
        $achievementService->complete($achievement, $user);

        // $this->call("OthersTableSeeder");
    }
}
