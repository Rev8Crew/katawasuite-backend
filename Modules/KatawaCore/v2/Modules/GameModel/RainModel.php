<?php

namespace App\Modules\KatawaParser\v2\Modules\GameModel;

class RainModel extends ModelWith
{
    public function compile(): string
    {
        $array = ['relay', '"vfx/fx-rain-bg1.png"', '"vfx/fx-rain-bg2.png"', '"vfx/fx-rain-bg3.png"', '"vfx/fx-rain-bg4.png"', '"vfx/fx-rain-bg5.png"', '"vfx/fx-rain-bg6.png"', '1.0s'];
        return implode(' ', $array);
    }
}
