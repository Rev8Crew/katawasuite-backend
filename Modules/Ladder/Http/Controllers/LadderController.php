<?php

namespace Modules\Ladder\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Common\Response;
use Modules\Ladder\Http\Requests\GetYearRequest;
use Modules\Ladder\Services\LadderServiceInterface;

class LadderController extends Controller
{
    public function __construct(private readonly LadderServiceInterface $ladderService)
    {
    }


    public function getNewYearLadder(GetYearRequest $request): Response
    {
        $response = Response::make();
        $result = $this->ladderService->getNewYearLadder($request->integer('year'));

        return $response->withData($result);
    }

    public function getNewYearStats(GetYearRequest $request): Response
    {
        $response = Response::make();
        $result = $this->ladderService->getNewYearStats($request->integer('year'));

        return $response->withData($result);
    }
}
