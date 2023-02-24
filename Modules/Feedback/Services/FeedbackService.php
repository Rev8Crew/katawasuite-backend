<?php

declare(strict_types=1);

namespace Modules\Feedback\Services;

use Illuminate\Support\Facades\Mail;
use Modules\Feedback\Entities\DTO\FeedbackCreateDto;
use Modules\Feedback\Entities\Feedback;
use Modules\Feedback\Mail\NewFeedbackMail;

class FeedbackService implements FeedbackServiceInterface
{
    public function create(FeedbackCreateDto $dto): Feedback
    {
        return Feedback::create($dto->toArray());
    }

    public function sendFeedbackToEmail(Feedback $feedback): void
    {
        $driver = app()->environment('production') ? Mail::getDefaultDriver() : 'log';
        Mail::mailer($driver)->send(new NewFeedbackMail($feedback));
    }
}
