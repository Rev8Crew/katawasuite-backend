<?php

namespace Modules\Notifications\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\User\Entities\User;

class Notification extends Model
{
    public const TABLE = 'notifications';

    protected $table = self::TABLE;

    public function users() : BelongsToMany
    {
        return  $this->belongsToMany(User::class)->withTimestamps();
    }
}
