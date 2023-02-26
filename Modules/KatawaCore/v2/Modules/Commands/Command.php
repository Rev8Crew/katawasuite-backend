<?php

namespace Modules\KatawaCore\v2\Modules\Commands;

use Illuminate\Support\Collection;
use Modules\KatawaCore\v2\Modules\Scenarios\ScenarioCollection;

abstract class Command
{
    protected Collection $line;

    public function __construct(Collection $line)
    {
        $this->line = $line;
    }

    abstract public function run(): ScenarioCollection;
}
