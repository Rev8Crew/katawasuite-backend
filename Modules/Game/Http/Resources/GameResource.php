<?php

namespace Modules\Game\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Game\Entities\Game;

/** @mixin Game */
class GameResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'short' => $this->short,
            'dir' => $this->dir,
            'description' => $this->description,
            'short_description' => $this->short_description,
            'team_id' => $this->team_id,
            'parent_id' => $this->parent_id,

            'width' => $this->width,
            'height' => $this->height,

            'restriction' => $this->restriction,

            'icon_s' => $this->icon_small,
            'icon_b' => $this->icon_high,

            'thumb_s' => $this->thumbnail_small,
            'thumb_b' => $this->thumbnail_high,

            'image' => $this->image,
            'url' => route('game.play', ['short' => $this->short]).'#'.$this->short,
            'is_active' => $this->is_active,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
