<?php

namespace App\Modules\KatawaParser\v2\Modules\Commands;

use App\Modules\KatawaParser\v2\KatawaCore;
use App\Modules\KatawaParser\v2\Modules\Configs\Config;
use App\Modules\KatawaParser\v2\Modules\GameModel\BackgroundModel;
use App\Modules\KatawaParser\v2\Modules\GameModel\CharacterModel;
use App\Modules\KatawaParser\v2\Modules\GameModel\CrowdModel;
use App\Modules\KatawaParser\v2\Modules\GameModel\EventModel;
use App\Modules\KatawaParser\v2\Modules\GameModel\HeartAttackModel;
use App\Modules\KatawaParser\v2\Modules\GameModel\LineModel;
use App\Modules\KatawaParser\v2\Modules\GameModel\RainModel;
use App\Modules\KatawaParser\v2\Modules\GameModel\SteamModel;
use App\Modules\KatawaParser\v2\Modules\GameModel\TeaRoomModel;
use App\Modules\KatawaParser\v2\Modules\GameModel\UnknownModel;
use App\Modules\KatawaParser\v2\Modules\Helpers\KatawaHelper;
use App\Modules\KatawaParser\v2\Modules\Helpers\ScenarioCollectionHelper;
use App\Modules\KatawaParser\v2\Modules\Scenarios\Scenario;
use App\Modules\KatawaParser\v2\Modules\Scenarios\ScenarioCollection;
use App\Modules\KatawaParser\v2\Modules\Scenarios\ScenarioCollections;

class ShowCommand extends Command
{

    public function run(): ScenarioCollection
    {
        $lineFirst = $this->line->get(KatawaCore::ARG_FIRST);
        switch ($lineFirst) {
            case 'passoutOP1': {
                $heartAttack = HeartAttackModel::make($this->line);
                $bg = BackgroundModel::make(collect([ 'scene', '#000']));
                $character = CharacterModel::make(collect(['show', 'muto', 'normal']));

                ScenarioCollections::getInstance()->before(ScenarioCollectionHelper::fromModel($heartAttack->setOpacity('70')->dissolve()));
                ScenarioCollections::getInstance()->before(ScenarioCollectionHelper::fromModel($bg->dissolve()));

                return ScenarioCollectionHelper::fromModel($character->hide()->dissolve('2.0'));
            }
            case 'heartattack': {
                $heartAttack = HeartAttackModel::make($this->line);
                $heartAttack->setOpacity('30');
                $heartAttack->dissolve('0.1');
                $heartAttack->setSrc('heart_attack.png');

                return ScenarioCollectionHelper::fromModel($heartAttack);

            }
            case 'wallodrugs': {
                $model = LineModel::make(collect(["img", "@drugs", "\"drugs_white.gif\"", "dissolve", "1.0s"]));
                return ScenarioCollectionHelper::fromModel($model);

            }
            case 'snow': {
                $model = LineModel::make(collect(['anim', 'snow', '50%']));
                return ScenarioCollectionHelper::fromModel($model);
            }
            case 'crowd': {
                $model = CrowdModel::make($this->line);
                return ScenarioCollectionHelper::fromModel($model);
            }
            case 'bg': {
                $model = BackgroundModel::make($this->line);
                return ScenarioCollectionHelper::fromModel($model);
            }
            case 'ev': {
                $model = EventModel::make($this->line);
                return ScenarioCollectionHelper::fromModel($model);
            }
            case 'steam': {
                $model = SteamModel::make($this->line);
                $model->setOpacity('40');
                return ScenarioCollectionHelper::fromModel($model);
            }
            case 'rain': {
                $model = RainModel::make($this->line);
                return ScenarioCollectionHelper::fromModel($model);
            }
            case 'white': {
                $background = BackgroundModel::make(collect(['bg', '#FFF']));
                $background->dissolve('1.0');

                return ScenarioCollection::make(new Scenario($background));
            }
        }

        if (KatawaHelper::isContainCharacter($lineFirst)) {
            $character = CharacterModel::make($this->line);

            if ($character->isInvisible) {
                return ScenarioCollectionHelper::fromModel(UnknownModel::make($this->line));
            }

            return ScenarioCollectionHelper::fromModel($character);
        }

        if (stripos($lineFirst, "tearoom_") !== false) {
            $tearoom = TeaRoomModel::make($this->line);
            return ScenarioCollectionHelper::fromModel($tearoom);
        }


        $model = UnknownModel::make($this->line)->setDebug();
        return ScenarioCollection::make(new Scenario($model));
    }
}
