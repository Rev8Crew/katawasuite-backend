<?php

namespace Modules\KatawaCore\v2\Modules\GameModel;

use Modules\KatawaCore\v2\KatawaCore;
use Modules\KatawaCore\v2\Modules\Tools\Tools;

class UnknownModel extends Model
{
    public bool $debug = true;

    public function compile(): string
    {
        if ($this->debug) {
            Tools::addDebugInfo('[UnkownModel] Debug Line', $this->line);
        }

        $result = $this->isStartWithComment($this->line->get(KatawaCore::ARG_COMMAND, '')) ?
            [...$this->line] :
            ['#', ...$this->line];

        return implode(self::DELIMITER, $result);
    }

    public function isStartWithComment(string $string): bool
    {
        return isset($string[0]) && $string[0] === '#';
    }

    public function setDebug(bool $debug = true): UnknownModel
    {
        $this->debug = $debug;

        return $this;
    }
}
