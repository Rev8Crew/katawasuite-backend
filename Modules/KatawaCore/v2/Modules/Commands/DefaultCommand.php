<?php

namespace Modules\KatawaCore\v2\Modules\Commands;

use Modules\KatawaCore\v2\Modules\GameModel\UnknownModel;
use Modules\KatawaCore\v2\Modules\Scenarios\Scenario;
use Modules\KatawaCore\v2\Modules\Scenarios\ScenarioCollection;

class DefaultCommand extends Command
{
    public function run(): ScenarioCollection
    {
        $model = UnknownModel::make($this->line);

        return ScenarioCollection::make(new Scenario($model, false, $this->line->count() < 1));
    }
}
