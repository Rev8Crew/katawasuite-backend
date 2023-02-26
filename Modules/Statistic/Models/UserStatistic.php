<?php

namespace Modules\Statistic\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\User\Entities\User;

/**
 * Modules\Statistic\Models\UserStatistic
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $game_id
 * @property string $option
 * @property string|null $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserStatistic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserStatistic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserStatistic query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserStatistic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserStatistic whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserStatistic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserStatistic whereOption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserStatistic whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserStatistic whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserStatistic whereValue($value)
 * @mixin \Eloquent
 */
class UserStatistic extends Model
{
    public const TABLE = 'user_statistics';

    protected $table = self::TABLE;

    protected $fillable = [
        'user_id',
        'game_id',
        'option',
        'value',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
