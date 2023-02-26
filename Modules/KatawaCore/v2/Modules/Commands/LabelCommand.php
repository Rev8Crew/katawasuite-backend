<?php

namespace Modules\KatawaCore\v2\Modules\Commands;

use Modules\KatawaCore\v2\KatawaCore;
use Modules\KatawaCore\v2\Modules\GameModel\LineModel;
use Modules\KatawaCore\v2\Modules\Scenarios\Scenario;
use Modules\KatawaCore\v2\Modules\Scenarios\ScenarioCollection;

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
