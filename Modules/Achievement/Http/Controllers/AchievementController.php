<?php

namespace Modules\Achievement\Http\Controllers;

use App\Helpers\RequestHelper;
use App\Http\Controllers\Controller;
use App\Models\Common\Response;
use Modules\Achievement\Http\Requests\CompleteByShortRequest;
use Modules\Achievement\Http\Resources\AchievementResource;
use Modules\Achievement\Services\AchievementServiceInterface;
use Modules\Game\Entities\Game;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class AchievementController extends Controller
{
    public function __construct(private readonly AchievementServiceInterface $achievementService)
    {
    }

    public function getAchievementsByCurrentUser(): Response
    {
        $response = Response::make();

        $achievements = $this->achievementService->getCompletedByUser(request()->user());

        return $response->withData(AchievementResource::collection($achievements));
    }

    public function getAchievementsByGame(Game $game): Response
    {
        $response = Response::make();

        $achievements = $this->achievementService->getAllByGame($game);

        return $response->withData(AchievementResource::collection($achievements));
    }

    public function completeByShort(CompleteByShortRequest $request): Response
    {
        $response = Response::make();

        if (! RequestHelper::isFromFrontend($request)) {
            return $response->withError(SymfonyResponse::HTTP_BAD_REQUEST, '');
        }

        $achievement = $this->achievementService->getAchievementByShort($request->input('short'));
        $user = $request->user();

        $complete = $this->achievementService->complete($achievement, $user);

        return $complete ? $response->withData(AchievementResource::make($complete)) : $response->success();
    }
}
