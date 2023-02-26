<?php

namespace Modules\Statistic\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Game\Entities\Game;
use Modules\User\Entities\User;

/**
 * Modules\Statistic\Models\TimeTracker
 *
 * @property int $id
 * @property int $user_id
 * @property int $game_id
 * @property int $start
 * @property int $end
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Game $game
 * @property-read User $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|TimeTracker newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TimeTracker newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TimeTracker query()
 * @method static \Illuminate\Database\Eloquent\Builder|TimeTracker whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimeTracker whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimeTracker whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimeTracker whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimeTracker whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimeTracker whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimeTracker whereUserId($value)
 *
 * @mixin \Eloquent
 */
class TimeTracker extends Model
{
    public const TABLE = 'time_trackers';

    protected $table = self::TABLE;

    protected $fillable = [
        'start',
        'end',
        'game_id',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }
}
