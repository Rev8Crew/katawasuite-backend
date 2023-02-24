<?php

namespace Modules\Game\Http\Controllers;

use App\Models\Common\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Modules\Game\Entities\Game;
use Modules\Game\Http\Requests\GameSyncRequest;
use Modules\Game\Http\Resources\GameResource;
use Modules\Game\Services\GameServiceInterface;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class GameController extends Controller
{
    public function __construct(
        private readonly GameServiceInterface $gameService,
    ) {
    }

    public function index(): Response
    {
        $response = Response::make();

        $games = $this->gameService->getAllGames();

        return $response->withData(GameResource::collection($games));
    }

    public function show(string $short): Response
    {
        $response = Response::make();

        try {
            $games = collect([$this->gameService->getGameByShort($short)]);
        } catch (ModelNotFoundException $exception) {
            return $response->withError(SymfonyResponse::HTTP_NOT_FOUND, '');
        }

        return $response->withData(GameResource::collection($games));
    }

    public function play(string $short)
    {
        try {
            $game = $this->gameService->getGameByShort($short);
        } catch (ModelNotFoundException $exception) {
            abort(SymfonyResponse::HTTP_NOT_FOUND);
        }

        return view('game::games', compact('game'));
    }

    public function sync(GameSyncRequest $request): Response
    {
        $response = Response::make();

        $user = $request->user();
        $game = Game::find($request->input('game_id'));

        if ($request->input('data')) {
            $this->gameService->saveGameDataByUser($request->input('data'), $game, $user);
        }

        $loads = $this->gameService->getUserSavesByGame($user, $game);

        return $response->withData($loads);
    }
}
