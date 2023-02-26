<?php

namespace Modules\KatawaCore\v2\Modules\GameModel;

use Modules\KatawaCore\v2\Modules\Tools\Tools;

class HeartAttackModel extends ModelWith
{
    public const COMMAND = 'img';
    public const CHARACTER = '@heartattack';

    public string $opacity = '';
    public string $src = '';

    public function compile(): string
    {
        $output = self::COMMAND.' '.self::CHARACTER;

        if ($this->src) {
            $output.= ' '.Tools::quoted($this->src);
        }

        if ($this->opacity) {
            $output.= ' '. 'opacity' . ' '.$this->opacity.'%';
        }

        $parent = parent::compile();
        if ($parent) {
            $output.= ' '.$parent;
        }

        return $output;
    }

    /**
     * @param string $opacity
     * @return HeartAttackModel
     */
    public function setOpacity(string $opacity): HeartAttackModel
    {
        $this->opacity = $opacity;
        return $this;
    }

    /**
     * @param string $src
     * @return HeartAttackModel
     */
    public function setSrc(string $src): HeartAttackModel
    {
        $this->src = $src;
        return $this;
    }
}
