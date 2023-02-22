<?php

namespace Modules\User\Entities\DTO;

use App\Enums\ActiveStatusEnum;

class RegisterDto
{
    public function __construct(
        public string $name,
        public ?string $email,
        public ?string $password = null,
        public ?string $phone = null,
        public ?ActiveStatusEnum $status = null,
        public ?bool $verified = false
    ) {}

    /**
     * @return string
     */
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

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @return ActiveStatusEnum|null
     */
    public function getStatus(): ?ActiveStatusEnum
    {
        return $this->status;
    }

    /**
     * @return bool|null
     */
    public function getVerified(): ?bool
    {
        return $this->verified;
    }
}
