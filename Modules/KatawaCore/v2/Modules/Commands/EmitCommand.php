<?php

namespace Modules\KatawaCore\v2\Modules\Commands;

use Modules\KatawaCore\v2\KatawaCore;
use Modules\KatawaCore\v2\Modules\GameModel\UnknownModel;
use Modules\KatawaCore\v2\Modules\GameModel\WrittenNote;
use Modules\KatawaCore\v2\Modules\Scenarios\Scenario;
use Modules\KatawaCore\v2\Modules\Scenarios\ScenarioCollection;

class EmitCommand extends Command
{
    public function run(): ScenarioCollection
    {
        if (
            (
                strpos($this->line->get(KatawaCore::ARG_FIRST), 'written_note') !== false ||
                strpos($this->line->get(KatawaCore::ARG_FIRST), 'fixedwritten_note') !== false
            ) &&
            // Проверяем что нет нескольких u в нашей записке, иначе это сложная конструкция для парсинга
            (
                $this->line->filter(fn (string $sentence) => strpos($sentence, 'u') !== false)->count() === 1 ||
                $this->line->filter(fn (string $sentence) => strpos($sentence, 'u') !== false)->count() === 0
            )
        ) {
            $note = WrittenNote::make($this->line)->setHtml();

            return ScenarioCollection::make(new Scenario($note));
        }

        $model = UnknownModel::make($this->line)->setDebug();

        return ScenarioCollection::make(new Scenario($model));
    }
}
