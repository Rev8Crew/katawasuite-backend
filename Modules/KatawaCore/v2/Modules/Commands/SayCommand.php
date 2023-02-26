<?php

namespace Modules\KatawaCore\v2\Modules\Commands;

use Modules\KatawaCore\v2\Modules\GameModel\CharacterSayModel;
use Modules\KatawaCore\v2\Modules\Scenarios\Scenario;
use Modules\KatawaCore\v2\Modules\Scenarios\ScenarioCollection;

class SayCommand extends Command
{
    public function run(): ScenarioCollection
    {
        $model = CharacterSayModel::make($this->line);

        return ScenarioCollection::make(new Scenario($model));
    }
}
