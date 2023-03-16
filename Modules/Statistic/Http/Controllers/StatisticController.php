<?php

namespace Modules\Statistic\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Common\Response;
use Modules\Statistic\Enums\StatisticOptionsEnum;
use Modules\Statistic\Http\Requests\GetStatisticRequest;
use Modules\Statistic\Http\Requests\StatisticRequest;
use Modules\Statistic\Services\StatisticServiceInterface;

class StatisticController extends Controller
{
    public function __construct(private StatisticServiceInterface $statisticService)
    {
    }

    public function addUserStatisticGame(StatisticRequest $request): Response
    {
        $response = Response::make();

        $user = $request->user();
        $game_id = $request->input('game_id');
        $option = $request->input('option');

        $this->statisticService->createForUserAndGame(
            $user->id,
            $game_id,
            StatisticOptionsEnum::from($option),
            $request->input('value', '1')
        );

        return $response->success();
    }

    public function getUserStatisticByGame(GetStatisticRequest $request): Response
    {
        $response = new Response();

        $user = $request->user();
        $game_id = $request->input('game_id');

        $counted = $this->statisticService->getUserStatisticByGame($user->id, $game_id)->groupBy('option')->map(function ($values) {
            return $values->count();
        });

        return $response->withData($counted);
    }
}
