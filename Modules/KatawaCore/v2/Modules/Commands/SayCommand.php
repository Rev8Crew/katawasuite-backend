<?php

namespace App\Modules\KatawaParser\v2\Modules\Commands;

use App\Modules\KatawaParser\v2\Modules\GameModel\CharacterSayModel;
use App\Modules\KatawaParser\v2\Modules\Scenarios\Scenario;
use App\Modules\KatawaParser\v2\Modules\Scenarios\ScenarioCollection;

class SayCommand extends Command
{

    public function run(): ScenarioCollection
    {
        $model = CharacterSayModel::make($this->line);
        return ScenarioCollection::make( new Scenario($model));
    }
}
