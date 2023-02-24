<?php

namespace Modules\Notifications\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modules\Notifications\Models\NotificationDelivery
 *
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationDelivery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationDelivery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationDelivery query()
 * @mixin \Eloquent
 */
class NotificationDelivery extends Model
{
    public const TABLE = 'notification_delivery';

    protected $table = self::TABLE;
}
