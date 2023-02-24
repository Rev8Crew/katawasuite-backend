<?php

namespace Modules\Feedback\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\User\Entities\User;

class Feedback extends Model
{
    public const TABLE = 'feedback';

    protected $table = self::TABLE;

    protected $fillable = [
        'name',
        'email',
        'text',
        'user_id',
        'relation',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
