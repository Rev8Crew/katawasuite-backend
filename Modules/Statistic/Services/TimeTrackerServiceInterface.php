<?php

declare(strict_types=1);

namespace Modules\Statistic\Services;

use Modules\Statistic\Models\TimeTracker;

interface TimeTrackerServiceInterface
{
    public function create(int $userId, int $gameId, int $start, int $end): TimeTracker;

    public function findByUserIdAndGameId(int $userId, int $gameId): ?TimeTracker;

    public function getTimeSpentByUserForGame(int $userId, ?int $gameId = null): ?string;
}
