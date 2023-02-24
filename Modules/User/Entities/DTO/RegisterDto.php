<?php

namespace Modules\User\Entities\DTO;

use App\Enums\ActiveStatusEnum;

readonly class RegisterDto
{
    public function __construct(
        public string $name,
        public ?string $email,
        public ?string $password = null,
        public ?string $phone = null,
        public ?ActiveStatusEnum $status = null,
        public ?bool $verified = false
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return ?string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getStatus(): ?ActiveStatusEnum
    {
        return $this->status;
    }

    public function getVerified(): ?bool
    {
        return $this->verified;
    }
}
