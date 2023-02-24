<?php

namespace Modules\Notifications\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\User\Entities\User;

class NotificationRelease extends Model
{
    public const TABLE = 'notification_releases';

    protected $table = self::TABLE;

    protected $fillable = [
        'title',
        'body',
        'color',
        'icon',
        'notification_id'
    ];

    public function notification(): BelongsTo
    {
        return $this->belongsTo(Notification::class);
    }

    public function notificationDelivery(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'notification_delivery')->withTimestamps();
    }
}
