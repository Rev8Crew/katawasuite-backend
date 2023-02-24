<?php

namespace Modules\Notification\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Notification\Models\NotificationRelease;

/** @mixin NotificationRelease */
class NotificationReleaseResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'color' => $this->color,
            'icon' => $this->icon,

            'created_at' => $this->created_at->format('d.m.Y H:i:s'),
            'updated_at' => $this->updated_at,

            'notification' => NotificationResource::make($this->whenLoaded('notification')),
        ];
    }
}
