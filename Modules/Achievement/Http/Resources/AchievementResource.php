<?php

namespace Modules\Achievement\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Achievement\Models\Achievement;
use Modules\Game\Http\Resources\GameResource;
use Modules\User\Http\Resources\UserResource;

/** @mixin Achievement */
class AchievementResource extends JsonResource
{
    /**
     * @param  Request  $request
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'short' => $this->short,
            'game_id' => $this->game_id,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,

            'users' => UserResource::collection($this->whenLoaded('users')),
            'rewards' => RewardResource::collection($this->whenLoaded('rewards')),
            'game' => GameResource::make($this->whenLoaded('game')),
        ];
    }
}
