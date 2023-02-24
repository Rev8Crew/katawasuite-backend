<?php

namespace Modules\Achievement\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Achievement\Models\AchievementReward;

/** @mixin AchievementReward  */
class RewardResource extends JsonResource
{
    /**
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'achievement_id' => $this->achievement_id,

            'type' => $this->type,
            'value' => $this->value,
            'achievement' => AchievementResource::make($this->whenLoaded('achievement')),
        ];
    }
}
