<?php

namespace Modules\Notification\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modules\Notification\Models\NotificationDelivery
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationDelivery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationDelivery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationDelivery query()
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationDelivery whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationDelivery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationDelivery whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class NotificationDelivery extends Model
{
    public const TABLE = 'notification_delivery';

    protected $table = self::TABLE;
}
