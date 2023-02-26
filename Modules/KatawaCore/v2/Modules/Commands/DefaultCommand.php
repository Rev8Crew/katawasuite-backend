<?php

namespace App\Modules\KatawaParser\v2\Modules\Commands;

use App\Modules\KatawaParser\v2\Modules\GameModel\LineModel;
use App\Modules\KatawaParser\v2\Modules\GameModel\UnknownModel;
use App\Modules\KatawaParser\v2\Modules\Scenarios\Scenario;
use App\Modules\KatawaParser\v2\Modules\Scenarios\ScenarioCollection;

class DefaultCommand extends Command
{
    public function run(): ScenarioCollection
    {
        $model = UnknownModel::make($this->line);
        return ScenarioCollection::make(new Scenario($model, false, $this->line->count() < 1));
    }
}
