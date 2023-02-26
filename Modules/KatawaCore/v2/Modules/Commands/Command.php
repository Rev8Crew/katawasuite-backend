<?php

namespace Modules\KatawaCore\v2\Modules\Commands;

use Modules\KatawaCore\v2\KatawaCore;
use Modules\KatawaCore\v2\Modules\Scenarios\ScenarioCollection;
use Illuminate\Support\Collection;

abstract class Command
{
    protected Collection $line;

    public function __construct(Collection $line)
    {
        $this->line = $line;
    }

    abstract public function run() : ScenarioCollection;
}
