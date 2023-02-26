<?php

namespace App\Modules\KatawaParser\v2\Modules\Dto;

class PositionDto
{
    protected string $x = "";
    protected string $y = "";

    public function __construct($x = '', $y = '') {
        if ($x) {
            $this->setX($x);
        }

        if ($y) {
            $this->setY($y);
        }
    }

    public static function make($x = '', $y = ''): PositionDto
    {
        return new self($x, $y);
    }

    /**
     * @param string $x
     * @return PositionDto
     */
    public function setX(string $x): PositionDto
    {
        $this->x = $x;
        return $this;
    }

    /**
     * @param string $y
     * @return PositionDto
     */
    public function setY(string $y): PositionDto
    {
        $this->y = $y;
        return $this;
    }

    /**
     * @return string
     */
    public function getX(): string
    {
        return $this->x;
    }

    /**
     * @return string
     */
    public function getY(): string
    {
        return $this->y;
    }


}
