<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Game\Entities\Game;

/**
 * Modules\User\Entities\UserGameSave
 *
 * @property int $id
 * @property array|null $data
 * @property int|null $slot
 * @property int $user_id
 * @property int $game_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Game $game
 * @property-read \Modules\User\Entities\User $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|UserGameSave newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGameSave newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGameSave query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGameSave whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGameSave whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGameSave whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGameSave whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGameSave whereSlot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGameSave whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGameSave whereUserId($value)
 *
 * @mixin \Eloquent
 */
class UserGameSave extends Model
{
    public const TABLE = 'user_game_saves';

    protected $table = self::TABLE;

    protected $fillable = [
        'data',
        'slot',
        'user_id',
        'game_id',
    ];

    protected $casts = [
        'data' => 'array',
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
