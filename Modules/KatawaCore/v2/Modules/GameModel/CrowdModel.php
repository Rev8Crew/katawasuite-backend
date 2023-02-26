<?php

namespace Modules\KatawaCore\v2\Modules\GameModel;

class CrowdModel extends ModelWith
{
    public bool $hide = false;

    public function compile(): string
    {
        if ($this->hide) {
            return $this->hide();
        }

        $array = ['relay', '"vfx/crowd1.png"', '"vfx/crowd2.png"', '"vfx/crowd3.png"', '1.0s'];
        return implode(' ', $array);
    }

    public function hide(): string
    {
        $array = ['relay', '~'];
        return implode(' ', $array);
    }

    public function setHide(bool $hide = true): CrowdModel
    {
        $this->hide = $hide;
        return $this;
    }


}
