<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Game\Entities\Game;

/**
 * Modules\User\Entities\UserFavoriteGames
 *
 * @property int $id
 * @property int $user_id
 * @property int $game_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Game $game
 * @property-read \Modules\User\Entities\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserFavoriteGames newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserFavoriteGames newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserFavoriteGames query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserFavoriteGames whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFavoriteGames whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFavoriteGames whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFavoriteGames whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFavoriteGames whereUserId($value)
 * @mixin \Eloquent
 */
class UserFavoriteGames extends Model
{
    public const TABLE = 'user_favorite_games';

    protected $table = self::TABLE;

    protected $fillable = [
        'user_id',
        'game_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class, 'game_id');
    }
}
