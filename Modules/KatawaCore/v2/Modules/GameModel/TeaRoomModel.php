<?php

namespace Modules\KatawaCore\v2\Modules\GameModel;

use Modules\KatawaCore\v2\KatawaCore;
use Modules\KatawaCore\v2\Modules\Tools\GamePath;
use Modules\KatawaCore\v2\Modules\Tools\Tools;

class TeaRoomModel extends ModelWith
{
    public const COMMAND = 'img';
    public const CHARACTER = '@';
    public const EXTENSION = '.png';

    public string $src;
    public string $name;

    public function parse() : self
    {
        $src = $this->line->get(KatawaCore::ARG_FIRST);
        $bonus = $this->line->get(KatawaCore::ARG_SECOND);

        $this->name = $src;

        if ($bonus) {
            $src .= '_'.$bonus;
        }

        $gamePath = GamePath::getInstance();
        $file = $gamePath->getForegroundSubPath('event'). 'lilly_supercg'. $gamePath->getDirSeparator(). $src.'.png';
        if (!$gamePath->exists($file)) {
            Tools::addDebugInfo('[TeaRoom] File doesn\'t exists: ' . $file);
        }

        $this->src = 'event/lilly_supercg/'.$src.'.png';
        return parent::parse();
    }

    public function compile(): string
    {
        return self::COMMAND.' '.self::CHARACTER.$this->name. ' '.Tools::quoted($this->src);
    }
}
