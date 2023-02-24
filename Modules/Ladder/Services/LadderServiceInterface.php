<?php
declare(strict_types=1);

namespace Modules\Ladder\Services;

use Illuminate\Support\Collection;

interface LadderServiceInterface
{
    public function getNewYearLadder2022(): Collection;

    public function getNewYearStats2022(): Collection;
}
