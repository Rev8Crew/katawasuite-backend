<?php

declare(strict_types=1);

namespace Modules\Feedback\Services;

use Modules\Feedback\Entities\DTO\FeedbackCreateDto;
use Modules\Feedback\Entities\Feedback;

interface FeedbackServiceInterface
{
    public function create(FeedbackCreateDto $dto): Feedback;

    public function sendFeedbackToEmail(Feedback $feedback): void;
}
