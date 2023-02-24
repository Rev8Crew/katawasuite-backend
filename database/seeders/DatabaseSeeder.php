<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Game\Database\Seeders\GameDatabaseSeeder;
use Modules\User\Database\Seeders\UserDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserDatabaseSeeder::class,
            GameDatabaseSeeder::class,
        ]);
    }
}
