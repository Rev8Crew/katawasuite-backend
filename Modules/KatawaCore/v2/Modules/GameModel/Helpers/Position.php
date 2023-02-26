<?php

namespace Modules\KatawaCore\v2\Modules\GameModel\Helpers;


use Modules\KatawaCore\v2\Modules\Tools\Tools;

class Position
{
    protected string $x = "";
    protected string $y = "";

    protected float $time = 0.0;

    protected bool $dissolve = false;

    public function getX(): string
    {
        return $this->x;
    }

    /**
     * @throws \Exception
     */
    public function setX(string $x): self
    {
        if ( !$this->isPositionXExists($x)) {
            throw new \Exception("Position X '$x' not valid");
        }
        $this->x = $x;

        return $this;
    }

    public function getY(): string
    {
        return $this->y;
    }

    /**
     * @param string $y
     * @throws \Exception
     */
    public function setY(string $y): self
    {
        if ( !$this->isPositionYExists($y)) {
            throw new \Exception("Position Y '$y' not valid");
        }
        $this->y = $y;

        return $this;
    }

    private function isPositionXExists(string $position): bool
    {
        /**
         *  Позиция может быть задана словом
         */
        $isPositionWord= in_array($position, [ 'left', 'right', 'left-in', 'right-in', 'left-out', 'right-out', 'center']);

        /**
         *  Позиция может быть задана процентами от -100% до 100%
         */
        $isPositionNum = (int)str_replace('%', '', $position);

        return $isPositionWord || $isPositionNum;
    }

    /**
     * @param string $position
     * @return bool
     */
    private function isPositionYExists(string $position): bool
    {
        /**
         *  Позиция может быть задана словом
         */
        $isPositionWord= in_array($position, [ 'top', 'bottom', 'top-in', 'bottom-in', 'top-out', 'bottom-out', 'center']);

        /**
         *  Позиция может быть задана процентами от -100% до 100%
         */
        $isPositionNum = (int)str_replace('%', '', $position);

        return $isPositionWord || $isPositionNum;
    }

    public function compile(): array
    {
        $output = [ $this->getX(), $this->getY() ];

        if ($this->time && $this->time > 0.0) {

            if ($this->dissolve) {
                $output[] = 'dissolve';
            }

            $output[] = Tools::endWithS($this->time);

        }
        return $output;
    }

    public function isIsset() : bool {
        return ($this->getX() && $this->getY()) || isset($this->time);
    }

    /**
     * @param float $time
     */
    public function setTime(float $time): void
    {
        $this->time = $time;
    }

    /**
     * @param float $time
     */
    public function setDissolve(float $time): void
    {
        $this->time = $time;
        $this->dissolve = true;
    }

}
