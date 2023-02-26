<?php

namespace Modules\User\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Notification\Http\Resources\NotificationResource;
use Modules\User\Entities\User;

/** @mixin User */
class UserResource extends JsonResource
{
    private string $_token = '';

    /**
     * @param  Request  $request
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'created_at' => Carbon::parse($this->created_at)->format('d.m.Y H:i:s'),
            'updated_at' => Carbon::parse($this->updated_at)->format('d.m.Y H:i:s'),
            'token' => $this->when((bool) $this->_token, $this->_token),
            'image' => $this->image,

            'notifications' => NotificationResource::collection($this->whenLoaded('notifications')),

            'ach_created' => $this->whenPivotLoaded('achievement_user', function () {
                // @phpstan-ignore-next-line
                return $this->pivot->created_at->translatedFormat('d F Y');
            }),
        ];
    }

    public function setToken(string $token): void
    {
        $this->_token = $token;
    }
}
