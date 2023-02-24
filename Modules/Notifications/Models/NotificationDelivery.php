<?php

namespace Modules\Notifications\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationDelivery extends Model
{
    public const TABLE = 'notification_delivery';

    protected $table = self::TABLE;
}
