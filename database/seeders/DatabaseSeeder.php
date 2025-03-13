<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\default\UserSeeder;
use Database\Seeders\default\SchoolSeeder;
use Database\Seeders\default\SessionSeeder;
use Database\Seeders\default\LanguageSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
    */

    public function run(): void
    {
        $this->call(LanguageSeeder::class);
        $this->call(SchoolSeeder::class);
        $this->call(SessionSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(UserSeeder::class);
    }
}
