<?php

namespace Modules\KatawaCore\v2\Modules\Commands;

use Modules\KatawaCore\v2\KatawaCore;
use Modules\KatawaCore\v2\Modules\GameModel\CharacterModel;
use Modules\KatawaCore\v2\Modules\GameModel\CrowdModel;
use Modules\KatawaCore\v2\Modules\GameModel\SteamModel;
use Modules\KatawaCore\v2\Modules\Scenarios\Scenario;
use Modules\KatawaCore\v2\Modules\Scenarios\ScenarioCollection;

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
