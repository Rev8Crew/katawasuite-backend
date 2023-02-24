<?php

declare(strict_types=1);

namespace Modules\Statistic\Enums;

enum StatisticOptionsEnum: string
{
    case StartGame = 'start';
    case ContinueGame = 'continue';
    case SaveGame = 'save';
    case LoadGame = 'load';
}
