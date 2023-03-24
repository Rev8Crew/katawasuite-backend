<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Common\Response;
use Modules\User\Http\Requests\ChangePhoneRequest;
use Modules\User\Http\Resources\UserSocialResource;
use Modules\User\Services\UserServiceInterface;
use Modules\User\Services\UserSocialServiceInterface;

class UserController extends Controller
{
    public function __construct(
        private readonly UserSocialServiceInterface $userSocialService,
        private readonly UserServiceInterface $userService
    ) {
    }

    public function getSocialProviders(): Response
    {
        $response = Response::make();

        $data = $this->userSocialService->getSocialsByUser(request()->user());

        return $response->withData(UserSocialResource::collection($data));
    }

    public function changePhone(ChangePhoneRequest $request): Response
    {
        $response = Response::make();
        $phone = $request->input('phone');
        $user = $request->user();

        if($this->userService->changePhone($user, $phone)) {
            return $response->success();
        }

        return $response->success();
    }

}
