<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Common\Response;
use Modules\Game\Entities\Game;
use Modules\User\Http\Requests\AddGameToFavoritesRequest;
use Modules\User\Services\UserFavoriteGamesServiceInterface;

class UserFavoriteGamesController extends Controller
{
    public function __construct(
        private readonly UserFavoriteGamesServiceInterface $favoriteGamesService
    ) {
    }

    public function addToFavorites(AddGameToFavoritesRequest $request): Response
    {
        $response = Response::make();
        $game = Game::find($request->input('id'));

        $collection = $this->favoriteGamesService->addGameToUserFavorites($game, request()->user());

        return $response->withData($collection);
    }

    public function removeFromFavorites(AddGameToFavoritesRequest $request): Response
    {
        $response = Response::make();
        $game = Game::find($request->input('id'));

        $collection = $this->favoriteGamesService->removeGameFromUserFavorites($game, request()->user());

        return $response->withData($collection);
    }

    public function getUserFavorites(): Response
    {
        return Response::make()->withData($this->favoriteGamesService->getListOfUserFavorites(request()->user()));
    }
}
