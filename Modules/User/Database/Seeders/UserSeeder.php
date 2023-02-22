<?php

namespace Modules\User\Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $root = User::create([
            'id' => 1,
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => \Hash::make('admin'),
            'email_verified_at' => Carbon::now(),
            'phone' => null,
        ]);
    }
}
