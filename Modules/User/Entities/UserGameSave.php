<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Game\Entities\Game;
use Modules\User\Entities\User;

class UserGameSave extends Model
{
    public const TABLE = 'user_game_saves';

    protected $fillable = [
        'data',
        'slot',
        'user_id',
        'game_id',
    ];

    protected $casts = [
        'data' => 'array'
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
