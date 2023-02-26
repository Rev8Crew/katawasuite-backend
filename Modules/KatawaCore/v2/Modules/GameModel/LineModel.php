<?php

namespace Modules\KatawaCore\v2\Modules\GameModel;

class LineModel extends Model
{
    public function compile(): string
    {
        return $this->line->implode(self::DELIMITER);
    }
}
