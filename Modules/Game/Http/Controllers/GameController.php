<?php

namespace Modules\Game\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class GameController extends Controller
{
    private FavoriteService $favoriteService;
    private GameService $gameService;

    public function __construct(FavoriteService $favoriteService, GameService $gameService)
    {
        $this->favoriteService = $favoriteService;
        $this->gameService = $gameService;
    }

    /**
     *  Path: /web/games
     *  Return: array with games and mods
     */
    public function index(): Response
    {
        $response = new Response();

        $games = $this->gameService->getAllGames();
        return $response->withData(GameResource::collection($games));
    }

    /**
     *  Path: /web/games/$short
     *  Return: array with games and mods
     */
    public function show(string $short): Response
    {
        $response = new Response();

        try {
            $games = collect([$this->gameService->getGameByShort($short)]);
        } catch (ModelNotFoundException $exception) {
            return $response->withError(SymfonyResponse::HTTP_NOT_FOUND, '');
        }

        return $response->withData(GameResource::collection($games));
    }

    /**
     * Path: /web/games/play/{short}
     * Return: view with vnds for selected game by it short name
     *
     * @param string $short
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|View
     */
    public function play(string $short)
    {

        try {
            $game = $this->gameService->getGameByShort($short);
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }

        return view('games', compact('game'));
    }

    /**
     *  /web/games/sync
     */
    public function sync(GameSyncRequest $request): Response
    {
        $response = new Response();

        $user = $request->user();
        $game = Game::find($request->input('game_id'));

        if ($request->input('data')) {
            $this->gameService->saveGameDataByUser($request->input('data'),$game, $user );
        }

        $loads = $this->gameService->getUserSavesByGame($user, $game);
        return $response->withData($loads);
    }

    public function addToFavorites(AddGameToFavoritesRequest $request): Response
    {
        $response = new Response();
        $game = Game::find($request->input('id'));

        $collection = $this->favoriteService->addGameToUserFavorites($game, request()->user());

        return $response->withData($collection);
    }

    public function removeFromFavorites(AddGameToFavoritesRequest $request): Response
    {
        $response = new Response();
        $game = Game::find($request->input('id'));

        $collection = $this->favoriteService->removeGameFromUserFavorites($game, request()->user());

        return $response->withData($collection);
    }

    public function getUserFavorites(): Response
    {
        $response = new Response();
        return $response->withData($this->favoriteService->getListOfUserFavorites(request()->user()));
    }
}
