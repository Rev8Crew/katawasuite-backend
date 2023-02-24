<?php

declare(strict_types=1);

namespace App\Enums;

enum ResponseStatusEnum: int
{
    case Success = 0;
    case Error = 1;
    case Unknown = 2;
}
