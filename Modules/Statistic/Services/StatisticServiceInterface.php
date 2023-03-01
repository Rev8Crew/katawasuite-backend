<?php
declare(strict_types=1);

namespace Modules\Statistic\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Statistic\Enums\StatisticOptionsEnum;
use Modules\Statistic\Models\UserStatistic;

interface StatisticServiceInterface
{
    public function createForUserAndGame(
        int $userId,
        int $gameId,
        StatisticOptionsEnum $optionsEnum,
        string $value
    ): UserStatistic;


    /**
     * @return Collection|UserStatistic[]
     */
    public function getUserStatisticByGame( int $userId, int $gameId): Collection;
}
