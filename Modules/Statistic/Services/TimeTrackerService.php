<?php

declare(strict_types=1);

namespace Modules\Statistic\Services;

use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Builder;
use Modules\Statistic\Models\TimeTracker;

class TimeTrackerService implements TimeTrackerServiceInterface
{
    public function getTimeSpentByUserForGame(int $userId, ?int $gameId = null): ?string
    {
        $trackers = TimeTracker::query()
            ->where('user_id', $userId)
            ->when($gameId, fn (Builder $builder) => $builder->where('game_id', $gameId))
            ->where('end', '>', 0)
            ->orderByDesc('id')
            ->get();

        $time = 0;
        /** @var TimeTracker $tracker */
        foreach ($trackers as $tracker) {
            $time += $tracker->end - $tracker->start;
        }

        $time = $time > 10 ? CarbonInterval::seconds($time)->cascade()->forHumans() : null;

        return $time;
    }

    public function create(int $userId, int $gameId, int $start, int $end): TimeTracker
    {
        return TimeTracker::create([
            'user_id' => $userId,
            'game_id' => $gameId,
            'start' => $start,
            'end' => $end,
        ]);
    }

    public function findByUserIdAndGameId(int $userId, int $gameId): ?TimeTracker
    {
        return TimeTracker::where('game_id', $gameId)->where('user_id', $userId)->orderByDesc('id')->first();
    }
}
