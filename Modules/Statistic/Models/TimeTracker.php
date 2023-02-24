<?php

namespace Modules\Statistic\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Game\Entities\Game;
use Modules\User\Entities\User;

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
