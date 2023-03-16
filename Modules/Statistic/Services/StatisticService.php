<?php

declare(strict_types=1);

namespace Modules\Statistic\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Statistic\Enums\StatisticOptionsEnum;
use Modules\Statistic\Models\UserStatistic;

class StatisticService implements StatisticServiceInterface
{
    public function createForUserAndGame(int $userId, int $gameId, StatisticOptionsEnum $optionsEnum, string $value): UserStatistic
    {
        return UserStatistic::create([
            'user_id' => $userId,
            'game_id' => $gameId,
            'option' => $optionsEnum->value,
            'value' => $value,
        ]);
    }

    public function getUserStatisticByGame(int $userId, int $gameId): Collection
    {
        return UserStatistic::whereGameId($gameId)->whereUserId($userId)->get();
    }
}
