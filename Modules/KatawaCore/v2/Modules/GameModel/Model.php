<?php

namespace Modules\KatawaCore\v2\Modules\GameModel;

use Modules\KatawaCore\v2\KatawaCore;
use Illuminate\Support\Collection;

abstract class Model
{
    public const DELIMITER = ' ';
    protected bool $isSkipped = false;
    protected Collection $line;

    public function __construct(Collection $line)
    {
        $this->line = $line;
    }

    public static function make(Collection $line, bool $parse = true)
    {
        // @phpstan-ignore-next-line
        $self = new static($line);

        if ($parse) {
            $self->parse();
        }

        return $self;
    }

    abstract public function compile() : string;

    public function parse() {
        return $this;
    }

    /**
     * @return Collection
     */
    public function getLine(): Collection
    {
        return $this->line;
    }

    /**
     * @param Collection $line
     */
    public function setLine(Collection $line): void
    {
        $this->line = $line;
    }

    /**
     * @param bool $isSkipped
     * @return Model
     */
    public function setIsSkipped(bool $isSkipped = true): Model
    {
        $this->isSkipped = $isSkipped;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSkipped(): bool
    {
        return $this->isSkipped;
    }
}
