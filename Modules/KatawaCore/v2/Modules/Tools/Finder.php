<?php
declare(strict_types=1);

namespace Modules\KatawaCore\v2\Modules\Tools;

use Illuminate\Support\Collection;
use Modules\KatawaCore\v2\Modules\GameModel\CharacterSayModel;
use Modules\KatawaCore\v2\Modules\GameModel\LineModel;
use Modules\KatawaCore\v2\Modules\GameModel\TextModel;
use Modules\KatawaCore\v2\Modules\GameModel\UnknownModel;
use Modules\KatawaCore\v2\Modules\Scenarios\Scenario;
use Modules\KatawaCore\v2\Modules\Scenarios\ScenarioCollection;

class Finder
{
    public static function findAnyTextScenario(Collection $scenarioCollections, bool $findCollection = false): Collection
    {
        $result = collect();

        $scenarioCollections->reverse()->each(static function (ScenarioCollection $scenarioCollection) use ($findCollection, $result) {
            $break = false;
            $scenarioCollection->getCollection()->reverse()->each(static function (Scenario $scenario) use ($scenarioCollection, $findCollection, $result, &$break) {

                $isTextModel = $scenario->getModel() instanceof TextModel || $scenario->getModel() instanceof CharacterSayModel;
                if ( $isTextModel) {
                    $break = true;
                    $result->push($findCollection ? $scenarioCollection : $scenario);
                }
            });

            if ($break) {
                return false;
            }

            return true;
        });

        return $result->filter()->unique();
    }
}
