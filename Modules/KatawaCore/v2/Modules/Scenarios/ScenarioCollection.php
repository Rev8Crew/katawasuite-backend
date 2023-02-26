<?php

namespace Modules\KatawaCore\v2\Modules\Scenarios;

use Illuminate\Support\Collection;

class ScenarioCollection
{
    /**
     *  Коллекция из сценариев
     */
    protected Collection $collection;

    public function __construct()
    {
        $this->collection = collect();
    }

    public static function make(Scenario $scenario): ScenarioCollection
    {
        return (new self())->insert($scenario);
    }

    public function getCollection(): Collection
    {
        return $this->collection;
    }

    public function insert(Scenario $scenario)
    {
        $this->collection->push($scenario);

        return $this;
    }
}
