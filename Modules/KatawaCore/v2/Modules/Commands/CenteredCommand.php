<?php

declare(strict_types=1);

namespace Modules\KatawaCore\v2\Modules\Commands;

use Modules\KatawaCore\v2\KatawaCore;
use Modules\KatawaCore\v2\Modules\GameModel\TextModel;
use Modules\KatawaCore\v2\Modules\Scenarios\Scenario;
use Modules\KatawaCore\v2\Modules\Scenarios\ScenarioCollection;

class CenteredCommand extends Command
{
    public function run(): ScenarioCollection
    {
        $this->line->forget(KatawaCore::ARG_COMMAND);

        $model = TextModel::make($this->line);

        return ScenarioCollection::make(new Scenario($model));
    }
}
