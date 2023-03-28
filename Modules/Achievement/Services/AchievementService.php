<?php

declare(strict_types=1);

namespace Modules\Achievement\Services;

use DB;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Modules\Achievement\DTO\AchievementCreateDto;
use Modules\Achievement\Models\Achievement;
use Modules\Game\Entities\Game;
use Modules\User\Entities\User;

class AchievementService implements AchievementServiceInterface
{
    public function create(AchievementCreateDto $dto): Achievement
    {
        return Achievement::create($dto->toArray());
    }

    public function getCompletedByUser(User $user): Collection
    {
        $query = DB::query()
            ->select('achievements.id')
            ->from('achievements')
            ->join('achievement_user', 'achievements.id', '=', 'achievement_user.achievement_id')
            ->where('achievement_user.user_id', '=', $user->id)
            ->where('is_active', '=', '10')
            ->orderBy('achievement_user.created_at', 'desc')
            ->get();

        $resultCollection = collect();

        foreach ($query as $stdId) {
            $achievement = Achievement::find($stdId->id);
            $achievement->load(['rewards', 'users' => fn ($query) => $query->where('users.id', $user->id), 'game']);

            $resultCollection->push($achievement);
        }

        return $resultCollection;
    }

    public function getAllByGame(Game $game): Collection
    {
        return Achievement::whereGameId($game->id)->active()->with(['rewards', 'game'])->orderBy('short')->get();
    }

    public function getUsersByAchievements($startDate, $endDate): Collection
    {
        return DB::query()
            ->select([
                'users.id as user_id',
                'users.name as user_name',
                \DB::raw("COUNT('achievement_id') as achievements"),
            ])
            ->from('users')
            ->join('achievement_user', 'achievement_user.user_id', '=', 'users.id')
            ->groupBy('users.id', 'users.name')
            ->whereBetween('achievement_user.created_at', [$startDate, $endDate])
            ->orderByDesc('achievements')
            ->limit(15)
            ->get();
    }

    public function complete(Achievement $achievement, User $user): ?Achievement
    {
        if (
            DB::query()
                ->from('achievement_user')
                ->where('user_id', $user->id)
                ->where('achievement_id', $achievement->id)
                ->exists()
        ) {
            return null;
        }

        $user->achievements()->attach($achievement->id);

        return $achievement;
    }

    public function getAchievementByShort(string $short): ?Achievement
    {
        return Achievement::whereShort($short)->first();
    }

    public function getAllAndMarkByUser(User $user): EloquentCollection
    {
        $completed = $this->getCompletedByUser($user);

        $achievements = $this->getAll()
            ->load([
                'rewards',
                'game'
            ]);

        $achievements = $this->removeCompletedAchievementsFromAll($achievements, $completed);

        foreach ($completed->reverse() as $achievement) {
            $achievements->prepend($achievement);
        }

        return $achievements;
    }

    private function removeCompletedAchievementsFromAll(EloquentCollection $achievements, Collection $completed): EloquentCollection
    {
        $completedIds = $completed->pluck('id', 'id');

        return $achievements->reject(fn(Achievement $achievement) => isset($completedIds[$achievement['id']]));
    }

    public function getAll(): EloquentCollection
    {
        return Achievement::active()->get();
    }
}
