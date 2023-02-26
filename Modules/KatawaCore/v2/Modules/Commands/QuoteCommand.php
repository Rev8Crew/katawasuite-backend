<?php

namespace Modules\KatawaCore\v2\Modules\Commands;

use Modules\KatawaCore\v2\Modules\GameModel\TextModel;
use Modules\KatawaCore\v2\Modules\Scenarios\Scenario;
use Modules\KatawaCore\v2\Modules\Scenarios\ScenarioCollection;

class QuoteCommand extends Command
{

    public function run(): ScenarioCollection
    {
        $model = TextModel::make($this->line);
        return ScenarioCollection::make( new Scenario($model));
    }
}
