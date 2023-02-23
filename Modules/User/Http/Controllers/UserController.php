<?php

namespace Modules\User\Http\Controllers;

use App\Models\Common\Response;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Http\Resources\UserSocialResource;
use Modules\User\Services\UserServiceInterface;
use Modules\User\Services\UserSocialServiceInterface;

class UserController extends Controller
{
    public function __construct(
        private readonly UserServiceInterface $userService,
        private readonly UserSocialServiceInterface $userSocialService
    ) {}

    public function getSocialProviders(): Response
    {
        $response = Response::make();

        $data = $this->userSocialService->getSocialsByUser(request()->user());

        return $response->withData(UserSocialResource::collection($data));
    }
}
