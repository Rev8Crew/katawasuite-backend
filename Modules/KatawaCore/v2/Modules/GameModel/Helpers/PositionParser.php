<?php

namespace Modules\KatawaCore\v2\Modules\GameModel\Helpers;

use Illuminate\Support\Collection;
use Modules\KatawaCore\v2\KatawaCore;
use Modules\KatawaCore\v2\Modules\Configs\Config;
use Modules\KatawaCore\v2\Modules\Dto\PositionDto;
use Modules\KatawaCore\v2\Modules\GameModel\BackgroundModel;
use Modules\KatawaCore\v2\Modules\GameModel\UnknownModel;
use Modules\KatawaCore\v2\Modules\Helpers\ScenarioCollectionHelper;
use Modules\KatawaCore\v2\Modules\Scenarios\ScenarioCollections;
use Modules\KatawaCore\v2\Modules\Tools\Tools;

class PositionParser
{
    protected Position $position;

    protected Collection $line;

    protected string $at;

    public function __construct(Position $position, Collection $line, string $at)
    {
        $this->position = $position;
        $this->line = $line;

        $this->at = $at;
    }

    public function parse(): self
    {
        $this->parseByPositionString();
        $this->parseByFullSpan();
        $this->parseByTransform();

        if (strpos($this->at, 'Slide') !== false) {
            $value = Tools::takeParamsFromFunction($this->at);

            if ($value <= 0.4) {
                $this->position->setX('left')->setY('center')->setTime(0.5);
            } else {
                $this->position->setX('right')->setY('center')->setTime(0.5);
            }

            ScenarioCollections::getInstance()->after(ScenarioCollectionHelper::fromModel(UnknownModel::make($this->line)));
        }

        return $this;
    }

    protected function parseByTransform()
    {
        // Если присутствует функция Transform, то необходимо залогировать данную строку
        // Чтобы автор смог сам определить что здесь лучше поставить
        if (strpos($this->at, 'Transform') !== false) {
            // Устанавливаем позицию по умолчанию
            $this->position->setX('center')->setY('center');

            ScenarioCollections::getInstance()->after(ScenarioCollectionHelper::fromModel(UnknownModel::make($this->line)));
        }
    }

    /*public function positionByTransform(string $str) {
        if (strpos($str, "Transform") !==false) {
            $re = '/Transform\(((\w*)=(\d+.\d+)).*\)/m';
            preg_match_all($re, $str, $matches, PREG_SET_ORDER, 0);

            if (
                $matches &&
                $matches[0] &&
                $matches[0][2] == 'xpos'
            ) {
                $xpos = (float)$matches[0][3];

                if ($xpos >= 0 && $xpos <= 0.2) {
                    $this->position = [ 'left-in', 'center'];
                }
                if ($xpos >= 0.4 && $xpos <= 0.6) {
                    $this->position = [ 'center', 'center'];
                }
                if ($xpos >= 0.8 && $xpos <= 1.0) {
                    $this->position = [ 'right-in', 'center'];
                }
            }
        }
    }*/

    private function getDirectionOfFullSpan(): string
    {
        /**
         * 0 => "show"
         * 1 => "bg"
         * 2 => "school_library"
         * 3 => "at"
         * 4 => "Fullpan(10.0"
         * 5 => "dir="
         * 6 => "left"
         * 7 => ")"
         */
        return stripos($this->line->get(KatawaCore::ARG_FIFTH, ''), 'dir') !== false ?
            $this->line->get(KatawaCore::ARG_FIFTH, '') : $this->line->get(KatawaCore::ARG_SIXTH, '');
    }

    public function parseByFullSpan()
    {
        if (strpos($this->at, 'Fullpan') === false) {
            return;
        }

        // show bg school_library at Fullpan(10.0, dir="left")
        // left - по умолчанию
        $direction = $this->getDirectionOfFullSpan() ?: 'left';

        // Формируем новую строку
        // Убираем скобку, если она есть [ Fullpan(10.0),"left") ]
        $string = str_replace(')', '', $this->at);

        // Дополняем до вида Fullpan(time.0, "direction")
        $string .= ','.Tools::quoted($direction).')';

        // парсим
        $re = '/.*\((\d+)\.\d+\,.*\"(.*)\".*\)/m';
        preg_match_all($re, $string, $matches, PREG_SET_ORDER, 0);

        $duration = 10.0;
        // Длительность
        if ($matches && $matches[0] && $matches[0][1]) {
            $duration = (float) $matches[0][1];
        }

        $align = 'right';
        if ($matches && $matches[0] && $matches[0][2]) {
            $align = $matches[0][2];
        }

        switch ($align) {
            case 'left':
                $this->position->setX('right')->setY('center');
                break;
            case 'right':
                $this->position->setX('left')->setY('center');
        }

        // FullSpan
        // Добавляем строку
        ScenarioCollections::getInstance()->after(ScenarioCollectionHelper::fromModel(BackgroundModel::make($this->line, false)->fullSpan($align, $duration)));
    }

    protected function parseByPositionString(): void
    {
        /**
         * @var string $key
         * @var PositionDto $value
         */
        foreach (Config::getInstance()->getConfigValue('positions') as $key => $value) {
            if ($this->at === $key) {
                $this->position->setX($value->getX())->setY($value->getY());
            }
        }
    }

    public function getPosition(): Position
    {
        return $this->position;
    }
}
