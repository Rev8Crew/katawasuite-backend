<?php

namespace Modules\KatawaCore\v2;

use Aedart\Config\Traits\ConfigLoaderTrait;
use Modules\KatawaCore\v2\Modules\Commands\Command;
use Modules\KatawaCore\v2\Modules\Configs\Config;
use Modules\KatawaCore\v2\Modules\Helpers\KatawaHelper;
use Modules\KatawaCore\v2\Modules\Scenarios\ScenarioCollections;
use Modules\KatawaCore\v2\Modules\Tools\GamePath;
use Modules\KatawaCore\v2\Modules\Tools\Lines;
use Illuminate\Support\Collection;

/**
 *  Модуль для парсинга визуальных новелл на Ren'Py
 */
class KatawaCore
{
    use ConfigLoaderTrait;

    public const ARG_COMMAND = 0;
    public const ARG_FIRST = 1;
    public const ARG_SECOND = 2;
    public const ARG_THIRD = 3;
    public const ARG_FOURTH = 4;
    public const ARG_FIFTH = 5;
    public const ARG_SIXTH = 6;

    public const EMPTY_LINE = [];

    protected ?GamePath $gamePath = null;
    protected Lines $lines;
    protected ScenarioCollections $scenarioCollections;

    protected Config $config;

    public function __construct(string $short)
    {
        $this->config = Config::getInstance($short);
        $this->gamePath = GamePath::getInstance()->setGamePath($this->getConfigValue('game_path'))->setSeparator();
        $this->lines = new Lines();
        $this->scenarioCollections = ScenarioCollections::getInstance();
    }

    /**
     *  Парсим каждую строку скрипта и возвращаем скомпилированный результат
     * @return string
     */
    public function parse() : string {

        $this->getLines()->get()->each(function (Collection $line) {
            $command = $this->command( $line->get(self::ARG_COMMAND, ''));
            $command = $this->getConfigValue('commands.'.$command) ?: $this->getConfigValue('commands.default');

            /** @var Command $commandClass */
            $commandClass = new $command($line);

            $scenarioCollection = $commandClass->run();
            $this->scenarioCollections->insert($scenarioCollection);
        });

        return $this->scenarioCollections->compile();
    }

    public function command(string $command) : string {
        if (KatawaHelper::isCharacter($command)) {
            return 'say';
        }

        if ($command) {
            switch ($command[0]) {
                case '$': return 'emit';
                case '|': return 'quote';
                case 'n': return 'note';
            }
        }

        return $command;
    }

    public function getConfigValue(string $value)
    {
        return $this->config->getConfigValue($value);
    }

    /**
     * @return Lines
     */
    public function getLines(): Lines
    {
        return $this->lines;
    }

    /**
     * @return ScenarioCollections
     */
    public function getScenarioCollections(): ScenarioCollections
    {
        return $this->scenarioCollections;
    }
}
