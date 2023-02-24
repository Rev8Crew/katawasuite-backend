<?php

namespace Modules\Ladder\Http\Controllers;

use App\Models\Common\Response;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Ladder\Services\LadderServiceInterface;

class LadderController extends Controller
{
    public function __construct(private readonly LadderServiceInterface $ladderService)
    {
    }

    public function getNewYearLadder2022() : Response {
        $response = Response::make();
        $result = $this->ladderService->getNewYearLadder2022();

        return $response->withData($result);
    }

    public function getNewYearStats2022(): Response {
        $response = Response::make();

        $result = $this->ladderService->getNewYearStats2022();

        return $response->withData($result);
    }
}
