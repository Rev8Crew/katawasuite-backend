<?php

namespace Modules\KatawaCore\v2\Modules\GameModel;

use Modules\KatawaCore\v2\Modules\Configs\Config;
use Modules\KatawaCore\v2\Modules\Helpers\KatawaHelper;
use Modules\KatawaCore\v2\Modules\Tools\Tools;

class TextModel extends Model
{
    public const QUOTE = '"';

    public string $text = '';

    public function parse() : self
    {
        $this->text = static::QUOTE;

        if ( $this->isQuote() ) {
            $this->line[0] = substr($this->line[0], 1);

            if ($this->line->count() > 1) {
                // |Врач|Реакция зрачков в норме. Сынок, как твоё имя?
                // -> [Врач] "Реакция зрачков в норме. Сынок, как твоё имя"
                $this->text = '[' . $this->line[0] . ']';
                $this->line->forget(0);

                if ($this->line->get(1)) {
                    $this->text .= ' ';
                    $this->text .= static::QUOTE;
                    $this->line[1] = substr($this->line[1], 1);
                }
            }
        }


        foreach ($this->line as $item) {
            $this->text .= $item;
        }

        $this->text = KatawaHelper::replaceCharactersFromMessage($this->text);

        $this->text .= static::QUOTE;
        return $this;
    }

    public function compile() : string
    {
        return $this->text;
    }

    private function isQuote() {
        return isset($this->line[0], $this->line[0][0]) && $this->line[0][0] === '|';
    }
}
