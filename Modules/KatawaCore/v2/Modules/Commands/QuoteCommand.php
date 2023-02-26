<?php

namespace App\Modules\KatawaParser\v2\Modules\Commands;

use App\Modules\KatawaParser\v2\Modules\GameModel\TextModel;
use App\Modules\KatawaParser\v2\Modules\Scenarios\Scenario;
use App\Modules\KatawaParser\v2\Modules\Scenarios\ScenarioCollection;

class QuoteCommand extends Command
{

    public function run(): ScenarioCollection
    {
        $model = TextModel::make($this->line);
        return ScenarioCollection::make( new Scenario($model));
    }
}
