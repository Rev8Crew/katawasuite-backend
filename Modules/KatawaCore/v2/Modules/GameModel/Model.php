<?php

namespace Modules\KatawaCore\v2\Modules\GameModel;

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

    abstract public function compile(): string;

    public function parse()
    {
        return $this;
    }

    public function getLine(): Collection
    {
        return $this->line;
    }

    public function setLine(Collection $line): void
    {
        $this->line = $line;
    }

    public function setIsSkipped(bool $isSkipped = true): Model
    {
        $this->isSkipped = $isSkipped;

        return $this;
    }

    public function isSkipped(): bool
    {
        return $this->isSkipped;
    }
}
