<?php

namespace App\Modules\KatawaParser\v2\Modules\Commands;

use App\Modules\KatawaParser\v2\KatawaCore;
use App\Modules\KatawaParser\v2\Modules\GameModel\MusicModel;
use App\Modules\KatawaParser\v2\Modules\GameModel\SfxModel;
use App\Modules\KatawaParser\v2\Modules\GameModel\SoundModel;
use App\Modules\KatawaParser\v2\Modules\GameModel\UnknownModel;
use App\Modules\KatawaParser\v2\Modules\Scenarios\Scenario;
use App\Modules\KatawaParser\v2\Modules\Scenarios\ScenarioCollection;

class PlayCommand extends Command
{

    public function run(): ScenarioCollection
    {
        switch ($this->line->get(KatawaCore::ARG_FIRST)) {
            case 'music': {
                $model = MusicModel::make($this->line);
                return ScenarioCollection::make( new Scenario($model));
            }
            case 'sound': {
                $model = SfxModel::make($this->line);
                return ScenarioCollection::make( new Scenario($model));
            }
            case 'ambient': {
                $model = SfxModel::make($this->line);
                return ScenarioCollection::make( new Scenario($model));
            }
        }

        $model = UnknownModel::make($this->line)->setDebug();
        return ScenarioCollection::make( new Scenario($model));
    }
}
