<?php

namespace App\Modules\KatawaParser\v2\Modules\GameModel;

use App\Modules\KatawaParser\v2\KatawaCore;
use App\Modules\KatawaParser\v2\Modules\GameModel\Helpers\Position;
use App\Modules\KatawaParser\v2\Modules\GameModel\Helpers\PositionParser;
use App\Modules\KatawaParser\v2\Modules\Tools\Tools;
use Illuminate\Support\Collection;

abstract class ModelWith extends Model
{
    public ?string $flip = null;

    public Position $position;

    public function __construct(Collection $line)
    {
        parent::__construct($line);

        $this->position = new Position();
    }

    public function __clone()
    {
        $this->position = clone $this->position;
    }

    public function flip($seconds = '1.0'): ModelWith
    {
        $this->flip = $seconds;

        return $this;
    }

    public function position(): ModelWith
    {
        $exists = null;

        if ( $this->line->get(KatawaCore::ARG_THIRD) === 'at') {
            $exists = KatawaCore::ARG_THIRD;
        }

        if ( $this->line->get(KatawaCore::ARG_SECOND) === 'at') {
            $exists = KatawaCore::ARG_SECOND;
        }

        if ( $exists ) {
            $at = $this->line->get($exists + 1);

            $parser = new PositionParser($this->position, $this->line, $at);
            $parser->parse();

            $this->position = $parser->getPosition();
        }

        return $this;
    }

    public function positionTime(float $seconds = 0.5) {
        $this->position->setTime($seconds);
        return $this;
    }

    /**
     * @param float $seconds
     */
    public function dissolve(float $seconds = 0.5) {
        $this->position->setDissolve($seconds);
        return $this;
    }

    public function compile(): string
    {
        $compile = collect();

        if ($this->position->isIsset()) {
            $compile = collect($this->position->compile());
        }

        if ($this->flip) {
            $compile->push('flip');
            $compile->push(Tools::endWithS($this->flip));
        }

        return trim($compile->implode(" "));
    }
}
