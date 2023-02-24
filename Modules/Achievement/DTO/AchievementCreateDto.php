<?php

namespace Modules\Achievement\DTO;

use App\Enums\ActiveStatusEnum;
use Illuminate\Contracts\Support\Arrayable;

readonly class AchievementCreateDto implements Arrayable
{
    public ?ActiveStatusEnum $activeStatus;

    public function __construct(
        public string $name,
        public string $description,
        public string $short,
        public ?int $gameId = null
    ) {
        $this->activeStatus = ActiveStatusEnum::Active;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'short' => $this->short,
            'is_active' => $this->activeStatus->value,
            'game_id' => $this->gameId,
        ];
    }
}
