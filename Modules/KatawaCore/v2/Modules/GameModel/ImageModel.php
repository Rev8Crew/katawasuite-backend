<?php

namespace Modules\KatawaCore\v2\Modules\GameModel;

class ImageModel extends ModelWith
{
    public const COMMAND = 'img';
    public bool $cls = false;

    public function compile(): string
    {
        $output = self::COMMAND;

        if ($this->cls) {
            $output .= ' ' . '~';
        }

        $output .= ' ' . parent::compile();

        return $output;
    }

    public function cls() : self {
        $this->cls = true;

        $this->setIsSkipped();
        return $this;
    }
}
