<?php

namespace Modules\Achievement\Models;

use App\Enums\ActiveStatusEnum;
use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Game\Entities\Game;
use Modules\User\Entities\User;

/**
 * Modules\Achievement\Models\Achievement
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $short
 * @property int|null $game_id
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Game|null $game
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Achievement\Models\AchievementReward> $rewards
 * @property-read int|null $rewards_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement active()
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement query()
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Achievement\Models\AchievementReward> $rewards
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $users
 * @mixin \Eloquent
 */
class Achievement extends Model
{
    use ActiveScope;

    public const TABLE = 'achievements';

    protected $table = self::TABLE;

    protected $fillable = [
        'name',
        'description',
        'is_active',
        'game_id',
        'short',
    ];

    protected $attributes = [
        'is_active' => ActiveStatusEnum::Active->value,
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'achievement_user')->withTimestamps();
    }

    public function rewards(): HasMany
    {
        return $this->hasMany(AchievementReward::class);
    }

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }
}
