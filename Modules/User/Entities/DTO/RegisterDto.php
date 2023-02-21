<?php

namespace Modules\User\Entities\DTO;

use App\Enums\ActiveStatusEnum;

class RegisterDto
{
    public string $name;
    public ?string $email;

    public ?string $password;
    public ?string $phone;

    public ?ActiveStatusEnum $status;
    public ?bool $verified;

    public function __construct(
        string $name,
        ?string $email,
        ?string $password = null,
        ?string $phone = null,
        ?ActiveStatusEnum $status = null,
        ?bool $verified = false
    ) {

        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->phone = $phone;
        $this->status = $status;
        $this->verified = $verified;
    }

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
