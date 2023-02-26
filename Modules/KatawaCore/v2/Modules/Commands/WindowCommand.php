<?php

namespace App\Modules\KatawaParser\v2\Modules\Commands;

use App\Modules\KatawaParser\v2\KatawaCore;
use App\Modules\KatawaParser\v2\Modules\GameModel\LineModel;
use App\Modules\KatawaParser\v2\Modules\Scenarios\Scenario;
use App\Modules\KatawaParser\v2\Modules\Scenarios\ScenarioCollection;

class WindowCommand extends Command
{

    public function run(): ScenarioCollection
    {
        $model = LineModel::make(collect(KatawaCore::EMPTY_LINE));
        return ScenarioCollection::make(new Scenario($model, false, true));
    }
}
