<?php

namespace App\Modules\KatawaParser\v2\Modules\Commands;

use App\Modules\KatawaParser\v2\KatawaCore;
use App\Modules\KatawaParser\v2\Modules\GameModel\NoteModel;
use App\Modules\KatawaParser\v2\Modules\GameModel\UnknownModel;
use App\Modules\KatawaParser\v2\Modules\GameModel\WrittenNote;
use App\Modules\KatawaParser\v2\Modules\Scenarios\Scenario;
use App\Modules\KatawaParser\v2\Modules\Scenarios\ScenarioCollection;

class EmitCommand extends Command
{

    public function run(): ScenarioCollection
    {
        if (
            (
                strpos( $this->line->get(KatawaCore::ARG_FIRST), 'written_note') !== false ||
                strpos( $this->line->get(KatawaCore::ARG_FIRST), 'fixedwritten_note') !== false
            ) &&
            // Проверяем что нет нескольких u в нашей записке, иначе это сложная конструкция для парсинга
            $this->line->filter(fn(string $sentence) => strpos($sentence, 'u') !== false)->count() === 1
        ) {
            $note = WrittenNote::make($this->line)->setHtml();

            return ScenarioCollection::make( new Scenario($note));
        }

        $model = UnknownModel::make($this->line)->setDebug();
        return ScenarioCollection::make( new Scenario($model));
    }
}
