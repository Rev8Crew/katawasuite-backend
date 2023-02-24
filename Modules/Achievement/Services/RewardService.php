<?php

declare(strict_types=1);

namespace Modules\Achievement\Services;

use App\Enums\ActiveStatusEnum;
use Modules\Achievement\Enums\RewardTypeEnum;
use Modules\Achievement\Models\AchievementReward;

class RewardService implements RewardServiceInterface
{
    public function create(
        RewardTypeEnum $rewardType,
        string $value,
        int $achievementId,
        int $active = ActiveStatusEnum::Active->value
    ): AchievementReward {
        return AchievementReward::create([
            'type' => $rewardType->value,
            'value' => $value,
            'achievement_id' => $achievementId,
            'is_active' => $active,
        ]);
    }
}
