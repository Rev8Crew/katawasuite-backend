<?php

namespace Modules\Achievement\Models;

use App\Enums\ActiveStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AchievementReward extends Model
{
    public const TABLE = 'achievement_rewards';

    protected $table = self::TABLE;

    protected $fillable = [
        'is_active',
        'type',
        'value',
        'achievement_id',
    ];

    protected $attributes = [
        'is_active' => ActiveStatusEnum::Active->value,
    ];

    public function achievement(): BelongsTo
    {
        return $this->belongsTo(Achievement::class);
    }
}
