<?php

namespace App\Modules\KatawaParser\v2\Modules\Commands;

use App\Modules\KatawaParser\v2\KatawaCore;
use App\Modules\KatawaParser\v2\Modules\GameModel\LineModel;
use App\Modules\KatawaParser\v2\Modules\Scenarios\Scenario;
use App\Modules\KatawaParser\v2\Modules\Scenarios\ScenarioCollection;

class LabelCommand extends Command
{

    public function run(): ScenarioCollection
    {
        $labelName = $this->line->get(KatawaCore::ARG_FIRST);
        // убираем префикс ru_ и ; в конце
        $labelName = str_replace(array('ru_', ':'), array('lab', ''), $labelName);

        $this->line->put(KatawaCore::ARG_FIRST, $labelName);

        $line = LineModel::make($this->line);
        return ScenarioCollection::make( new Scenario($line));
    }
}
