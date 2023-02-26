<?php

namespace Modules\KatawaCore\v2\Modules\Commands;

use Modules\KatawaCore\v2\KatawaCore;
use Modules\KatawaCore\v2\Modules\GameModel\BackgroundModel;
use Modules\KatawaCore\v2\Modules\GameModel\EventModel;
use Modules\KatawaCore\v2\Modules\GameModel\LineModel;
use Modules\KatawaCore\v2\Modules\GameModel\UnknownModel;
use Modules\KatawaCore\v2\Modules\Scenarios\Scenario;
use Modules\KatawaCore\v2\Modules\Scenarios\ScenarioCollection;
use Modules\KatawaCore\v2\Modules\Scenarios\ScenarioCollections;

class SceneCommand extends Command
{
    public function run(): ScenarioCollection
    {
        switch ($this->line->get(KatawaCore::ARG_FIRST)) {
            case 'black':
                $line = LineModel::make(collect(['cls']));
                $background = BackgroundModel::make(collect(['bg', '#000']));

                ScenarioCollections::getInstance()->before(ScenarioCollection::make(new Scenario($line)));

                return ScenarioCollection::make(new Scenario($background));

            case 'bg':
                $background = BackgroundModel::make($this->line);

                return ScenarioCollection::make(new Scenario($background));

            case 'white':
                $background = BackgroundModel::make(collect(['bg', '#FFF']));
                $background->dissolve('1.0');

                return ScenarioCollection::make(new Scenario($background));

            case 'ev':
                $event = EventModel::make($this->line);

                return ScenarioCollection::make(new Scenario($event));
        }

        $model = UnknownModel::make($this->line)->setDebug();

        return ScenarioCollection::make(new Scenario($model));
    }
}
