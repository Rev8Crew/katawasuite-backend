<?php

declare(strict_types=1);

namespace Modules\Achievement\Services;

use Illuminate\Support\Collection;
use Modules\Achievement\DTO\AchievementCreateDto;
use Modules\Achievement\Models\Achievement;
use Modules\Game\Entities\Game;
use Modules\User\Entities\User;

interface AchievementServiceInterface
{
    public function create(AchievementCreateDto $dto): Achievement;

    public function getAchievementByShort(string $short): ?Achievement;

    public function getCompletedByUser(User $user): Collection;

    public function getAllByGame(Game $game): Collection;

    public function getUsersByAchievements(): Collection;

    /**
     *  Говорит о том, что пользователь получил достижение
     */
    public function complete(Achievement $achievement, User $user): ?Achievement;
}
