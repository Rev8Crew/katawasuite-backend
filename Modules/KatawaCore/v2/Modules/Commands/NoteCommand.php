<?php

namespace App\Modules\KatawaParser\v2\Modules\Commands;

use App\Modules\KatawaParser\v2\Modules\GameModel\NoteModel;
use App\Modules\KatawaParser\v2\Modules\Scenarios\Scenario;
use App\Modules\KatawaParser\v2\Modules\Scenarios\ScenarioCollection;

class NoteCommand extends Command
{

    public function run(): ScenarioCollection
    {
        $note = NoteModel::make($this->line)->setHtml(false);

        return ScenarioCollection::make( new Scenario($note));
    }
}
