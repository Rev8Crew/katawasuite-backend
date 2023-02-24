<?php

namespace Modules\User\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Game\Http\Resources\GameResource;
use Modules\User\Entities\UserFavoriteGames;

/** @mixin UserFavoriteGames */
class UserFavoritesGameResource extends JsonResource
{
    /**
     * @param  \Illuminate\Http\Request  $request
     */
    public function toArray($request): array
    {
        return [
            'user_id' => $this->user_id,
            'game_id' => $this->game_id,
            'game' => GameResource::make($this->whenLoaded('game')),
        ];
    }
}
