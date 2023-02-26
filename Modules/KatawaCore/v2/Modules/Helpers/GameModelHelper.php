<?php

namespace Modules\KatawaCore\v2\Modules\Helpers;

use Modules\KatawaCore\v2\Modules\GameModel\BackgroundModel;
use Modules\KatawaCore\v2\Modules\GameModel\EventModel;

class GameModelHelper
{
    public static function isInstanceBackground($model): bool
    {
        return $model instanceof BackgroundModel || $model instanceof EventModel;
    }
}
