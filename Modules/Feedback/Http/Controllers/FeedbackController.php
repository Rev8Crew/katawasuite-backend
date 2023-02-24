<?php

namespace Modules\Feedback\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Common\Response;
use Modules\Feedback\Entities\DTO\FeedbackCreateDto;
use Modules\Feedback\Http\Requests\FeedbackSendRequest;
use Modules\Feedback\Services\FeedbackServiceInterface;

class FeedbackController extends Controller
{
    public function __construct(private readonly FeedbackServiceInterface $feedbackService)
    {
    }

    public function send(FeedbackSendRequest $request): Response
    {
        $response = new Response();

        $feedback = $this->feedbackService->create(FeedbackCreateDto::fromArray($request->only(['name', 'email', 'text', 'user_id', 'relation'])));
        $this->feedbackService->sendFeedbackToEmail($feedback);

        return $response->success();
    }
}
