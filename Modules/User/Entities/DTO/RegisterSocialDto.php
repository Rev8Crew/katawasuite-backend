<?php
declare(strict_types=1);

namespace Modules\User\Entities\DTO;

use Illuminate\Contracts\Support\Arrayable;

class RegisterSocialDto implements Arrayable
{
    public function __construct(
        public string $provider,
        public string $providerId,
        public string $name,
        public string $avatar,
        public string $email
    ) {}

    public function toArray(): array
    {
        return [
            'provider' => $this->provider,
            'provider_id' => $this->providerId,
            'name' => $this->name,
            'avatar' => $this->avatar,
            'email' => $this->email
        ];
    }
}
