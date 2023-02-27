<?php

namespace Modules\User\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Modules\User\Entities\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        $root = User::create([
            'name' => 'admin',
            'email' => config('app.admin_default_email'),
            'password' => \Hash::make(config('app.admin_default_password')),
            'email_verified_at' => Carbon::now(),
            'phone' => null,
        ]);
    }
}
