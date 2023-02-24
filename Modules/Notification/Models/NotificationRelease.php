<?php

namespace Modules\Notification\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\User\Entities\User;

/**
 * Modules\Notification\Models\NotificationRelease
 *
 * @property int $id
 * @property string $title
 * @property string $body
 * @property string $color
 * @property string $icon
 * @property int $notification_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\Notification\Models\Notification $notification
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $notificationDelivery
 * @property-read int|null $notification_delivery_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationRelease newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationRelease newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationRelease query()
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationRelease whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationRelease whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationRelease whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationRelease whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationRelease whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationRelease whereNotificationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationRelease whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationRelease whereUpdatedAt($value)
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $notificationDelivery
 *
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
        'notification_id',
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
