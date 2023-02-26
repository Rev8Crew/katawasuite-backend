<?php

namespace App\Modules\KatawaParser\v2\Modules\Commands;

use App\Modules\KatawaParser\v2\KatawaCore;
use App\Modules\KatawaParser\v2\Modules\Scenarios\ScenarioCollection;
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
