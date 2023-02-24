<?php

namespace Modules\Notifications\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\User\Entities\User;

/**
 * Modules\Notifications\Models\NotificationRelease
 *
 * @property-read \Modules\Notifications\Models\Notification|null $notification
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $notificationDelivery
 * @property-read int|null $notification_delivery_count
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationRelease newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationRelease newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationRelease query()
 * @mixin \Eloquent
 */
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
