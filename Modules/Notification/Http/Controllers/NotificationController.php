<?php

namespace Modules\Notification\Http\Controllers;

use App\Models\Common\Response;
use Crypt;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Notification\Http\Resources\NotificationReleaseResource;
use Modules\Notification\Services\NotificationReleaseServiceInterface;
use Modules\Notification\Services\NotificationServiceInterface;
use Modules\User\Services\UserServiceInterface;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class NotificationController extends Controller
{
    public function __construct(
        private readonly NotificationReleaseServiceInterface $notificationReleaseService,
        private readonly NotificationServiceInterface $notificationService,
        private readonly UserServiceInterface $userService
    ) {

    }

    public function unsubscribe(string $code, string $token) {
        $email = Crypt::decryptString($token);

        $user = $this->userService->getUserByEmail($email);
        $notification = $this->notificationService->getByCode($code);

        if (!$user) {
            abort(SymfonyResponse::HTTP_BAD_REQUEST);
        }

        $this->notificationService->unsubscribe($user, $notification);
        return response(trans('notification.unsubscribed'));
    }

    public function subscribeToAll(): Response
    {
        $response = Response::make();

        $user = request()->user();
        $this->notificationService->subscribeToAll($user);

        return $response->success();
    }

    public function unsubscribeToAll(): Response
    {
        $response = Response::make();

        $user = request()->user();
        $this->notificationService->unsubscribeToAll($user);

        return $response->success();
    }

    public function getReleasesByUser(): Response
    {
        $response = Response::make();
        $user = request()->user();

        $data = $this->notificationReleaseService->getReleasesByUser($user);
        $data->load('notification')->take(6);

        return $response->withData(NotificationReleaseResource::collection($data));
    }
}
