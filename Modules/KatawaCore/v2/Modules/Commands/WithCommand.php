<?php

namespace Modules\KatawaCore\v2\Modules\Commands;

use Modules\KatawaCore\v2\KatawaCore;
use Modules\KatawaCore\v2\Modules\GameModel\BackgroundModel;
use Modules\KatawaCore\v2\Modules\GameModel\CharacterModel;
use Modules\KatawaCore\v2\Modules\GameModel\EventModel;
use Modules\KatawaCore\v2\Modules\GameModel\ImageModel;
use Modules\KatawaCore\v2\Modules\GameModel\LineModel;
use Modules\KatawaCore\v2\Modules\GameModel\ModelWith;
use Modules\KatawaCore\v2\Modules\GameModel\UnknownModel;
use Modules\KatawaCore\v2\Modules\Helpers\GameModelHelper;
use Modules\KatawaCore\v2\Modules\Helpers\ScenarioCollectionHelper;
use Modules\KatawaCore\v2\Modules\Scenarios\Scenario;
use Modules\KatawaCore\v2\Modules\Scenarios\ScenarioCollection;
use Modules\KatawaCore\v2\Modules\Scenarios\ScenarioCollections;
use Modules\KatawaCore\v2\Modules\Tools\Tools;

class WithCommand extends Command
{
    public function run(): ScenarioCollection
    {
        if (
            ! $this->charaexit() &&
            ! $this->vpunch() &&
            ! $this->charamove() &&
            ! $this->shuteye() &&
            ! $this->location() &&
            ! $this->charachange() &&
            ! $this->genericWhiteOut() &&
            ! $this->shorttimeskip()
        ) {
            $model = UnknownModel::make($this->line)->setDebug();

            return ScenarioCollection::make(new Scenario($model));
        }

        return ScenarioCollectionHelper::fromModel(LineModel::make(collect(KatawaCore::EMPTY_LINE)));
    }

    public function charaexit(): bool
    {
        $firstArg = $this->line->get(KatawaCore::ARG_FIRST);

        if (
            $firstArg === 'charaexit'
        ) {
            ScenarioCollections::getInstance()->after(ScenarioCollectionHelper::fromModel(LineModel::make(collect(['delay', '0.4s']))));

            return true;
        }

        return false;
    }

    public function vpunch(): bool
    {
        $firstArg = $this->line->get(KatawaCore::ARG_FIRST);

        if (
            $firstArg === 'vpunch'
        ) {
            $instance = ScenarioCollections::getInstance();
            $scenarioCollections = $instance->findWithScenarios();

            if ($scenarioCollections->isEmpty()) {
                $instance->after(ScenarioCollectionHelper::fromModel(LineModel::make(collect(['eff', 'v-shake', '50%', '2.0s']))));

                return true;
            }

            $modelWith = $scenarioCollections->first()->getModel();

            if (GameModelHelper::isInstanceBackground($modelWith)) {
                $instance->after(ScenarioCollectionHelper::fromModel(LineModel::make(collect(['eff', 'v-shake', '50%', '2.0s']))));

                return true;
            }

            if ($modelWith instanceof CharacterModel) {
                $instance->after(ScenarioCollectionHelper::fromModel(LineModel::make(collect(['eff', '@'.$modelWith->name, 'v-shake', '50%', '2.0s']))));

                return true;
            }
        }

        return false;
    }

    public function charamove(): bool
    {
        $firstArg = $this->line->get(KatawaCore::ARG_FIRST);

        if (
            $firstArg === 'charamove'
        ) {
            $scenarioCollections = ScenarioCollections::getInstance()->findWithScenarios();

            $scenarioCollections->each(static function (Scenario $scenario) {
                /** @var ModelWith $modelWith */
                $modelWith = $scenario->getModel();

                if ($modelWith instanceof CharacterModel) {
                    $modelWith->dissolve(1.0);
                }
            });

            return true;
        }

        return false;
    }

    public function shuteye(): bool
    {
        $firstArg = $this->line->get(KatawaCore::ARG_FIRST);

        if (
            $firstArg === 'ease' ||
            $firstArg === 'shuteye' ||
            stripos($firstArg, 'Pause') !== false
        ) {
            $model = LineModel::make(collect(['delay', '0.5s']));
            ScenarioCollections::getInstance()->after(ScenarioCollectionHelper::fromModel($model));

            return true;
        }

        if (
            $firstArg === 'openeye' ||
            stripos($firstArg, 'dissolve') !== false
        ) {
            if (stripos($firstArg, 'Dissolvechara') !== false) {
                return false;
            }

            $param = Tools::takeParamsFromFunction($firstArg);
            $scenarioCollections = ScenarioCollections::getInstance()->findWithScenarios();

            $scenarioCollections->each(static function (Scenario $scenario) use ($param) {
                /** @var ModelWith $modelWith */
                $modelWith = $scenario->getModel();

                if ($modelWith instanceof CharacterModel || GameModelHelper::isInstanceBackground($modelWith)) {
                    $modelWith->dissolve($param);
                }
            });

            return true;
        }

        return false;
    }

    public function location(): bool
    {
        $firstArg = $this->line->get(KatawaCore::ARG_FIRST);

        if (
            $firstArg === 'locationchange' ||
            $firstArg === 'locationskip'
        ) {
            $scenarioCollections = ScenarioCollections::getInstance()->findWithScenarios();
            $scenarioCollections->each(static function (Scenario $scenario) {
                /** @var ModelWith $modelWith */
                $modelWith = $scenario->getModel();

                if (GameModelHelper::isInstanceBackground($modelWith)) {
                    $modelWith->dissolve(1.0);
                }
            });

            $scenarioCollections = ScenarioCollections::getInstance()->findWithCollections();

            $scenarioCollections->each(static function (ScenarioCollection $scenarioCollection) {
                $collection = $scenarioCollection->getCollection();

                /** @var ModelWith $model */
                $model = $collection->first()->getModel();

                if (GameModelHelper::isInstanceBackground($model)) {
                    $collection->prepend(new Scenario(ImageModel::make(collect([]))->cls()->positionTime(0.5)));
                    $collection->prepend(new Scenario(LineModel::make(collect(['cls']))));
                }
            });

            return true;
        }

        return false;
    }

    public function charachange(): bool
    {
        $firstArg = $this->line->get(KatawaCore::ARG_FIRST);

        if (
            $firstArg === 'charachange' ||
            $firstArg === 'charaenter'
        ) {
            $scenarioCollections = ScenarioCollections::getInstance()->findWithScenarios();

            $scenarioCollections->each(static function (Scenario $scenario) {
                $modelWith = $scenario->getModel();

                if ($modelWith instanceof CharacterModel) {
                    $modelWith->dissolve(1.0);
                }
            });

            return true;
        }

        if (
            $firstArg === 'moveinleft' ||
            $firstArg === 'moveinright'
        ) {
            $scenarioCollections = ScenarioCollections::getInstance()->findWithScenarios();

            $scenarioCollections->each(static function (Scenario $scenario) {
                $modelWith = $scenario->getModel();

                if ($modelWith instanceof CharacterModel) {
                    $modelWith->positionTime(1.0);
                }
            });

            $scenarioCollections = ScenarioCollections::getInstance()->findWithCollections();

            $scenarioCollections->each(static function (ScenarioCollection $scenarioCollection) use ($firstArg) {
                $collection = $scenarioCollection->getCollection();

                /** @var ModelWith $model */
                $model = $collection->first()->getModel();

                if ($model instanceof CharacterModel) {
                    //show hisao_talk_small_u at right
                    //with moveinright
                    // -->
                    //img @hisao_talk_small_u right-in center
                    //img @hisao_talk_small_u right center 1.0s
                    //delay 0.5s
                    $clone = clone $model;
                    $clone->positionTime(0.1);
                    $clone->position->setX($firstArg === 'moveinleft' ? 'left-in' : 'right-in')->setY('center');

                    $model->path = '';
                    if ($model->position->getX() === '') {
                        $model->position->setX('center');
                        $model->position->setY('center');
                    }

                    $collection->prepend(new Scenario($clone, false));
                    $collection->push(new Scenario(LineModel::make(collect(['delay', '1.0s']), false)));
                }
            });

            return true;
        }

        return false;
    }

    public function genericWhiteOut(): bool
    {
        $firstArg = $this->line->get(KatawaCore::ARG_FIRST);

        if (stripos($firstArg, 'GenericWhiteout') !== false) {
            $scenarioCollections = ScenarioCollections::getInstance()->findWithCollections();

            $scenarioCollections->each(static function (ScenarioCollection $scenarioCollection) {
                $collection = $scenarioCollection->getCollection();

                /** @var ModelWith $model */
                $model = $collection->first()->getModel();

                if ($model instanceof EventModel) {
                    // cls
                    // img ~
                    // bg #FFF
                    // delay 2.0s

                    $collection->prepend(new Scenario(LineModel::make(collect(['delay', '0.5s']))));
                    $collection->prepend(new Scenario(LineModel::make(collect(['bg', '#FFF']))));
                    $collection->prepend(new Scenario(ImageModel::make(collect([]))->cls()));
                    $collection->prepend(new Scenario(LineModel::make(collect(['cls']))));
                }
            });

            return true;
        }

        return false;
    }

    public function shorttimeskip(): bool
    {
        $firstArg = $this->line->get(KatawaCore::ARG_FIRST);

        if (
            $firstArg === 'shorttimeskip'
        ) {
            $scenarioCollections = ScenarioCollections::getInstance()->findWithScenarios();

            $scenarioCollections->each(static function (Scenario $scenario) {
                $modelWith = $scenario->getModel();

                if ($modelWith instanceof BackgroundModel) {
                    $modelWith->flip();
                }
            });

            $scenarioCollections = ScenarioCollections::getInstance()->findWithCollections();

            $scenarioCollections->each(static function (ScenarioCollection $scenarioCollection) {
                $collection = $scenarioCollection->getCollection();

                /** @var ModelWith $model */
                $model = $collection->first()->getModel();

                if (GameModelHelper::isInstanceBackground($model)) {
                    // cls
                    // img ~
                    // sfx "sfx/time.ogg"

                    $collection->prepend(new Scenario(LineModel::make(collect(['sfx "sfx/time.ogg"']))));
                    $collection->prepend(new Scenario(ImageModel::make(collect([]))->cls()->positionTime()));
                    $collection->prepend(new Scenario(LineModel::make(collect(['cls']))));
                }
            });

            return true;
        }

        return false;
    }
}
