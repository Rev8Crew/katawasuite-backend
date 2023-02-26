<?php

namespace App\Modules\KatawaParser\v2\Modules\Helpers;

use App\Modules\KatawaParser\v2\Modules\GameModel\Model;
use App\Modules\KatawaParser\v2\Modules\Scenarios\Scenario;
use App\Modules\KatawaParser\v2\Modules\Scenarios\ScenarioCollection;
use Illuminate\Support\Collection;

class ScenarioCollectionHelper
{
    public static function fromModel(Model $model, bool $with = false) : ScenarioCollection {
        $scenario = new Scenario($model, $with);

        return ScenarioCollection::make($scenario);
    }

}
