<?php

namespace App\Modules\KatawaParser\v2\Modules\Scenarios;

use App\Modules\KatawaParser\v2\Modules\GameModel\UnknownModel;
use Illuminate\Support\Collection;

class ScenarioCollections
{
    public Collection $scenarioCollections;

    protected Collection $before;
    protected Collection $after;

    protected static ?ScenarioCollections $instance = null;

    public function __construct()
    {
        $this->scenarioCollections = collect();
        $this->before = collect();
        $this->after = collect();
    }

    public static function getInstance() : self {
        if (static::$instance === null) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     *  Скомпилировать сценарий в текст
     * @return string
     */
    public function compile(): string
    {
        $result = [];

        //dd($this->scenarioCollections);
        $this->scenarioCollections->each(static function (ScenarioCollection $scenarioCollection) use (&$result) {
            $scenarioCollection->getCollection()->each(static function (Scenario $scenario) use (&$result) {
                $compile = $scenario->compile();
                if ($compile && $scenario->isNotEmpty()) {
                    $result[] = $compile;
                }
            });
        });

        return implode(PHP_EOL, $result);
    }

    public function before(ScenarioCollection $scenarioCollection): ScenarioCollections
    {
        $this->before->push($scenarioCollection);
        return $this;
    }

    public function after(ScenarioCollection $scenarioCollection): ScenarioCollections
    {
        $this->after->push($scenarioCollection);
        return $this;
    }

    /**
     *  Добавить сценарий в глобальный массив
     * @param ScenarioCollection $scenarioCollection
     * @return $this
     */
    public function insert(ScenarioCollection $scenarioCollection): ScenarioCollections
    {
        $this->before = $this->before->each(function (ScenarioCollection $scenarioCollection) {
            $this->scenarioCollections->push($scenarioCollection);
        })->collect();

        $this->scenarioCollections->push($scenarioCollection);

        $this->after = $this->after->each(function (ScenarioCollection $scenarioCollection) {
            $this->scenarioCollections->push($scenarioCollection);
        })->collect();

        $this->before = collect();
        $this->after = collect();
        return $this;
    }

    public function findWithScenarios(): Collection
    {
        return $this->find();
    }

    public function findWithCollections(): Collection
    {
        return $this->find(true);
    }

    /**
     *
     */
    public function find(bool $findCollection = false): Collection
    {
        $result = collect();

        $this->scenarioCollections->reverse()->each(static function (ScenarioCollection $scenarioCollection) use ($findCollection, $result) {
            $break = true;
            $scenarioCollection->getCollection()->reverse()->each(static function (Scenario $scenario) use ($scenarioCollection, $findCollection, $result, &$break) {
                if (
                    $scenario->hasWithRelation() &&
                    !($scenario->getModel() instanceof UnknownModel) &&
                    !$scenario->getModel()->isSkipped()
                ) {
                    $break = false;
                    $result->push($findCollection ? $scenarioCollection : $scenario);
                }

                if ($scenario->isEmpty() || $scenario->getModel() instanceof UnknownModel || $scenario->getModel()->isSkipped()) {
                    $break = false;
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
