<?php

namespace App\Modules\KatawaParser\v2\Modules\Commands;

use App\Modules\KatawaParser\v2\KatawaCore;
use App\Modules\KatawaParser\v2\Modules\GameModel\CharacterModel;
use App\Modules\KatawaParser\v2\Modules\GameModel\CrowdModel;
use App\Modules\KatawaParser\v2\Modules\GameModel\SteamModel;
use App\Modules\KatawaParser\v2\Modules\Scenarios\Scenario;
use App\Modules\KatawaParser\v2\Modules\Scenarios\ScenarioCollection;

class HideCommand extends Command
{

    public function run(): ScenarioCollection
    {
        if ($this->line->get(KatawaCore::ARG_FIRST) === 'steam') {
            $steam = SteamModel::make($this->line)->setHide();
            return ScenarioCollection::make( new Scenario($steam) );
        }

        if ($this->line->get(KatawaCore::ARG_FIRST) === 'crowd') {
            $crowd = CrowdModel::make($this->line)->setHide();
            return ScenarioCollection::make( new Scenario($crowd) );
        }

        $character = CharacterModel::make($this->line, false)->hide();
        return ScenarioCollection::make( new Scenario($character) );
    }
}
