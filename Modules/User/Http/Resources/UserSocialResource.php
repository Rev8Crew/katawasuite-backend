<?php

namespace Modules\User\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\User\Entities\UserSocial;

/** @mixin UserSocial */
class UserSocialResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'provider' => $this->provider,
        ];
    }
}
