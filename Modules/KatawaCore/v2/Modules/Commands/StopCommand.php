<?php

namespace App\Modules\KatawaParser\v2\Modules\Commands;

use App\Modules\KatawaParser\v2\KatawaCore;
use App\Modules\KatawaParser\v2\Modules\GameModel\LineModel;
use App\Modules\KatawaParser\v2\Modules\GameModel\MusicModel;
use App\Modules\KatawaParser\v2\Modules\GameModel\UnknownModel;
use App\Modules\KatawaParser\v2\Modules\Scenarios\Scenario;
use App\Modules\KatawaParser\v2\Modules\Scenarios\ScenarioCollection;
use App\Modules\KatawaParser\v2\Modules\Scenarios\ScenarioCollections;

class StopCommand extends Command
{

    public function run(): ScenarioCollection
    {
        switch ($this->line->get(KatawaCore::ARG_FIRST)) {
            case 'music': {
                $music = MusicModel::make($this->line, false);
                $music->stop();

                return ScenarioCollection::make(new Scenario($music));
            }
            case 'ambient': {
                $sound = LineModel::make(collect(['sound', '~']));
                $relay = LineModel::make(collect(['relay', '~']));
                $sfx = LineModel::make(collect(['sfx', '~']));

                ScenarioCollections::getInstance()->before(ScenarioCollection::make(new Scenario($sound)));
                ScenarioCollections::getInstance()->before(ScenarioCollection::make(new Scenario($sfx)));
                return ScenarioCollection::make(new Scenario($relay));
            }
        }

        $model = UnknownModel::make($this->line)->setDebug();
        return ScenarioCollection::make( new Scenario($model));
    }
}
