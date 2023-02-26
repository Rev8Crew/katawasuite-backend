<?php

namespace App\Modules\KatawaParser\v2\Modules\Scenarios;

use Illuminate\Support\Collection;

class ScenarioCollection
{
    /**
     *  Коллекция из сценариев
     * @var Collection
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

    /**
     * @return Collection
     */
    public function getCollection(): Collection
    {
        return $this->collection;
    }

    public function insert(Scenario $scenario) {
        $this->collection->push($scenario);
        return $this;
    }

}
