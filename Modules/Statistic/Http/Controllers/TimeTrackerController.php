<?php

namespace Modules\Statistic\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Common\Response;
use Carbon\Carbon;
use Modules\Game\Http\Requests\GameSyncRequest;
use Modules\Statistic\Services\TimeTrackerServiceInterface;

class TimeTrackerController extends Controller
{
    public function __construct(private readonly TimeTrackerServiceInterface $timeTrackerService)
    {
    }

    public function start(GameSyncRequest $request): Response
    {
        $response = Response::make();
        $user = request()->user();

        $tracker = $this->timeTrackerService->create($user->id, $request->input('game_id'), Carbon::now()->getTimestamp(), 0);

        return $response->withData($tracker);
    }

    public function end(GameSyncRequest $request): Response
    {
        $response = Response::make();
        $user = request()->user();

        $tracker = $this->timeTrackerService->findByUserIdAndGameId($user->id, $request->input('game_id'));

        if ($tracker) {
            $tracker->update(['end' => Carbon::now()->getTimestamp()]);

            return $response->withData($tracker);
        }

        return $response->success();
    }

    public function timeByGame(GameSyncRequest $request): Response
    {
        $response = Response::make();
        $time = $this->timeTrackerService->getTimeSpentByUserForGame($request->user()->id, $request->input('game_id'));

        return $response->withData(['time' => $time]);
    }
}
