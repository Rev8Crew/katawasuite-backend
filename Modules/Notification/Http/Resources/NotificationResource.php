<?php

namespace Modules\Notification\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Notification\Models\Notification;

/** @mixin Notification */
class NotificationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'code' => $this->code,
            'short' => $this->short,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
