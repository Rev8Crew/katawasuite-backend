<?php

namespace App\Modules\KatawaParser\v2\Modules\GameModel;

class SteamModel extends ModelWith
{
    public const COMMAND = 'anim';
    public const EFFECT = 'fog';
    public string $opacity;
    public bool $hide = false;

    public function hide(): string
    {
        return self::COMMAND.' '.'~';
    }

    public function compile(): string
    {
        if($this->hide) {
            return $this->hide();
        }

        $opacity = '';
        if ($this->opacity) {
            $opacity = $this->opacity . '%';
        }

        return self::COMMAND.' '.self::EFFECT.' '.$opacity;
    }

    /**
     * @param string $opacity
     * @return SteamModel
     */
    public function setOpacity(string $opacity): SteamModel
    {
        $this->opacity = $opacity;
        return $this;
    }

    /**
     * @param bool $hide
     * @return SteamModel
     */
    public function setHide(bool $hide = true): SteamModel
    {
        $this->hide = $hide;
        return $this;
    }
}
