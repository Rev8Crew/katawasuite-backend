<?php

declare(strict_types=1);

namespace Modules\Achievement\Services;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Modules\Achievement\DTO\AchievementCreateDto;
use Modules\Achievement\Models\Achievement;
use Modules\Game\Entities\Game;
use Modules\User\Entities\User;

interface AchievementServiceInterface
{
    public function create(AchievementCreateDto $dto): Achievement;

    public function getAll(): EloquentCollection;

    public function getAchievementByShort(string $short): ?Achievement;

    public function getCompletedByUser(User $user): Collection;

    public function getAllByGame(Game $game): Collection;

    public function getUsersByAchievements(Carbon $startDate, Carbon $endDate): Collection;

    public function getAllAndMarkByUser(User $user): EloquentCollection;

    /**
     *  Говорит о том, что пользователь получил достижение
     */
    public function complete(Achievement $achievement, User $user): ?Achievement;
}
