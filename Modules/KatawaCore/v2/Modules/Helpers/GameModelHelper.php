<?php

namespace App\Modules\KatawaParser\v2\Modules\Helpers;

use App\Modules\KatawaParser\v2\Modules\GameModel\BackgroundModel;
use App\Modules\KatawaParser\v2\Modules\GameModel\EventModel;

class GameModelHelper
{
    public static function isInstanceBackground($model): bool
    {
        return $model instanceof BackgroundModel || $model instanceof EventModel;
    }
}
