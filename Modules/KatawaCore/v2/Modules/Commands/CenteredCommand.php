<?php
declare(strict_types=1);

namespace App\Modules\KatawaParser\v2\Modules\Commands;

use App\Modules\KatawaParser\v2\KatawaCore;
use App\Modules\KatawaParser\v2\Modules\GameModel\TextModel;
use App\Modules\KatawaParser\v2\Modules\Scenarios\Scenario;
use App\Modules\KatawaParser\v2\Modules\Scenarios\ScenarioCollection;

class CenteredCommand extends Command
{

    public function run(): ScenarioCollection
    {
        $this->line->forget(KatawaCore::ARG_COMMAND);

        $model = TextModel::make($this->line);
        return ScenarioCollection::make( new Scenario($model));
    }
}
