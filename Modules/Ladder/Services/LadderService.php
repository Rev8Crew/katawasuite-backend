<?php

declare(strict_types=1);

namespace Modules\Ladder\Services;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use DB;
use Illuminate\Support\Collection;
use Modules\Achievement\Models\Achievement;
use Modules\Achievement\Services\AchievementServiceInterface;
use Modules\Game\Entities\Game;
use Modules\Statistic\Models\UserStatistic;
use Modules\Statistic\Services\TimeTrackerServiceInterface;

class LadderService implements LadderServiceInterface
{
    public function __construct(
        private readonly AchievementServiceInterface $achievementService,
        private readonly TimeTrackerServiceInterface $timeTrackerService
    ) {
    }

    public function getNewYearLadder2022(): Collection
    {
        return $this->achievementService->getUsersByAchievements()->map(function (\stdClass $row) {
            return (array) $row;
        })->map(function (array $row) {
            return array_merge($row, ['time' => $this->timeTrackerService->getTimeSpentByUserForGame($row['user_id'])]);
        });
    }

    public function getNewYearStats2022(): Collection
    {
        $countStartButtonClick = UserStatistic::query()->whereOption('start')->count();
        $countSaveButtonClick = UserStatistic::query()->whereOption('continue')->count();
        $countLoadButtonClick = UserStatistic::query()->whereOption('load')->count();

        $countStartButtonByGame = $this->countOptionGroupByGame('start');
        $countSaveButtonByGame = $this->countOptionGroupByGame('continue');
        $countLoadButtonByGame = $this->countOptionGroupByGame('load');

        $startYearDate = Carbon::parse('2022-01-01 00:00:00');
        $endYearDate = Carbon::parse('2022-12-31 00:00:00');
        $novels = Game::active()->whereBetween('created_at', [$startYearDate, $endYearDate])->pluck('name', 'id');
        $achievementsCounts = Achievement::active()->whereBetween('created_at', [$startYearDate, $endYearDate])->count();

        $maxTimeByGame = DB::query()
            ->select([
                'users.name as user_name',
                'games.name as game_name',
                'games.id as game_id',
                DB::raw('end-start as difference'),
            ])
            ->from('time_trackers')
            ->join('users', 'users.id', '=', 'time_trackers.user_id')
            ->join('games', 'games.id', '=', 'time_trackers.game_id')
            ->where('end', '>', 0)
            ->orderByDesc('difference')
            ->groupBy(['users.name', 'games.name', 'games.id', 'start', 'end'])->limit(10)->get()
            ->map(fn (\stdClass $item) => array_merge((array) $item, [
                'difference' => CarbonInterval::seconds($item->difference)->cascade()->forHumans(),
            ]));

        return collect([
            'count_start_button_click' => $countStartButtonClick,
            'count_continue_button_click' => $countSaveButtonClick,
            'count_load_button_click' => $countLoadButtonClick,

            'count_start_button_by_game' => $countStartButtonByGame,
            'count_continue_button_by_game' => $countSaveButtonByGame,
            'count_load_button_by_game' => $countLoadButtonByGame,

            'novels' => $novels,
            'novels_count' => $novels->count(),

            'achievements_count' => $achievementsCounts,
            'max_time_by_game' => $maxTimeByGame,
        ]);
    }

    protected function countOptionGroupByGame(string $option): Collection
    {
        return DB::query()
            ->select([
                'games.id as game_id',
                'games.name as game_name',
                \DB::raw('count(*) as counted'),
            ])
            ->from('user_statistics')
            ->join('games', 'user_statistics.game_id', '=', 'games.id')
            ->where('option', $option)
            ->groupBy(['games.id', 'games.name'])
            ->get();
    }
}
