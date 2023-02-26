<?php

namespace Modules\Achievement\Models;

use App\Enums\ActiveStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modules\Achievement\Models\AchievementReward
 *
 * @property int $id
 * @property string $type
 * @property string|null $value
 * @property int $is_active
 * @property int $achievement_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\Achievement\Models\Achievement $achievement
 *
 * @method static \Illuminate\Database\Eloquent\Builder|AchievementReward newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AchievementReward newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AchievementReward query()
 * @method static \Illuminate\Database\Eloquent\Builder|AchievementReward whereAchievementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AchievementReward whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AchievementReward whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AchievementReward whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AchievementReward whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AchievementReward whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AchievementReward whereValue($value)
 *
 * @mixin \Eloquent
 */
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
