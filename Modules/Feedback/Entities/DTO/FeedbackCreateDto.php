<?php

namespace Modules\Feedback\Entities\DTO;

use Illuminate\Contracts\Support\Arrayable;

readonly class FeedbackCreateDto implements Arrayable
{
    public function __construct(
        public string $name,
        public string $email,
        public string $text,
        public int $userId,
        public string $relation
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self($data['name'], $data['email'], $data['text'], $data['user_id'], $data['relation'] ?? 'site');
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'text' => $this->text,
            'user_id' => $this->userId,
            'relation' => $this->relation,
        ];
    }
}
