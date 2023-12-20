<?php

declare(strict_types=1);

namespace Modules\Ladder\Services;

use Illuminate\Support\Collection;

interface LadderServiceInterface
{
    public function getNewYearLadder(int $year = 2022): Collection;

    public function getNewYearStats(int $year = 2022): Collection;
}
