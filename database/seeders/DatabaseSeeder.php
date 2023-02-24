<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Achievement\Database\Seeders\AchievementDatabaseSeeder;
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
            GameDatabaseSeeder::class,
            UserDatabaseSeeder::class,
            AchievementDatabaseSeeder::class
        ]);
    }
}
