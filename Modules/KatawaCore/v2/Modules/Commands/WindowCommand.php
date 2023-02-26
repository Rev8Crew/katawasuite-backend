<?php

namespace Modules\KatawaCore\v2\Modules\Commands;

use Modules\KatawaCore\v2\KatawaCore;
use Modules\KatawaCore\v2\Modules\GameModel\LineModel;
use Modules\KatawaCore\v2\Modules\Scenarios\Scenario;
use Modules\KatawaCore\v2\Modules\Scenarios\ScenarioCollection;

class WindowCommand extends Command
{
    public function run(): ScenarioCollection
    {
        $model = LineModel::make(collect(KatawaCore::EMPTY_LINE));

        return ScenarioCollection::make(new Scenario($model, false, true));
    }
}
