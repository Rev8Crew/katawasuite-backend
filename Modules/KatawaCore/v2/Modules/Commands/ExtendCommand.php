<?php

declare(strict_types=1);

namespace Modules\KatawaCore\v2\Modules\Commands;

use Modules\KatawaCore\v2\KatawaCore;
use Modules\KatawaCore\v2\Modules\GameModel\CharacterSayModel;
use Modules\KatawaCore\v2\Modules\GameModel\ModelWith;
use Modules\KatawaCore\v2\Modules\GameModel\TextModel;
use Modules\KatawaCore\v2\Modules\Helpers\GameModelHelper;
use Modules\KatawaCore\v2\Modules\Scenarios\Scenario;
use Modules\KatawaCore\v2\Modules\Scenarios\ScenarioCollection;
use Modules\KatawaCore\v2\Modules\Scenarios\ScenarioCollections;

class ExtendCommand extends Command
{
    public function run(): ScenarioCollection
    {
        $this->line->forget(KatawaCore::ARG_COMMAND);

        $scenarioCollections = ScenarioCollections::getInstance()->findAnyTextScenario();

        $model = clone $scenarioCollections->first()->getModel();
        $model->text = trim($this->line->implode(' '));

        if ($model instanceof TextModel) {
            $model->text = TextModel::QUOTE . $model->text . TextModel::QUOTE;
        }

        return ScenarioCollection::make(new Scenario($model));
    }
}
