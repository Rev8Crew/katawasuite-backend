<?php

namespace Modules\Statistic\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\User\Entities\User;

class UserStatistic extends Model
{
    public const TABLE = 'user_statistics';

    protected $table = self::TABLE;

    protected $fillable = [
        'user_id',
        'game_id',
        'option',
        'value'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
