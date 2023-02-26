<?php


namespace Modules\KatawaCore\v2\Modules\Scenarios;

use Modules\KatawaCore\v2\Modules\GameModel\Model;
use Modules\KatawaCore\v2\Modules\GameModel\ModelWith;

class Scenario
{
    protected $model;
    protected bool $isEmpty = false;
    protected bool $with = false;

    public function __construct(Model $model, bool $with = false, bool $isEmpty =false)
    {
        $this->model = $model;
        $this->with = $with;
        $this->isEmpty = $isEmpty;
    }

    public function isNotEmpty(): bool
    {
        return !$this->isEmpty();
    }

    public function isEmpty() : bool {
        return $this->isEmpty;
    }

    public function hasWithRelation() : bool {
        return $this->with || $this->getModel() instanceof ModelWith;
    }

    public function compile() : string {
        return $this->model->compile();
    }

    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->model;
    }
}
