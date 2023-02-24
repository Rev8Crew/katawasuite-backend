<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Game\Entities\Game;

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
