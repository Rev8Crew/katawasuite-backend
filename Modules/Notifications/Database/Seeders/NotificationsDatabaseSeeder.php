<?php

namespace Modules\Notifications\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Notifications\Enums\NotificationCodeEnum;
use Modules\Notifications\Models\Notification;
use Modules\User\Services\UserServiceInterface;

class NotificationsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run( UserServiceInterface $userService)
    {
        Model::unguard();

        $notification = Notification::create([
            'name' => 'Уведомление о новых новеллах',
            'short' => 'Новая новелла на сайте!',
            'description' => 'Каждый раз, при добавлении на сайт новой новеллы, вам будет приходить письмо на электронную почту, указанную в профиле',
            'code' => NotificationCodeEnum::AddedNewGame->value
        ]);

        $notification->users()->save($userService->getUserByEmail(config('app.admin_default_email')));

        // $this->call("OthersTableSeeder");
    }
}
