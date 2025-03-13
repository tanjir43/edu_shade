<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\core\ShiftSeeder;
use Database\Seeders\core\BranchSeeder;
use Database\Seeders\core\SchoolSeeder;
use Database\Seeders\core\VersionSeeder;
use Database\Seeders\default\UserSeeder;
use Database\Seeders\default\LanguageSeeder;
use Database\Seeders\core\SchoolSessionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
    */

    public function run(): void
    {
        $this->call(LanguageSeeder::class);
        $this->call(SchoolSeeder::class);
        $this->call(BranchSeeder::class);
        $this->call(SchoolSessionSeeder::class);
        $this->call(VersionSeeder::class);
        $this->call(ShiftSeeder::class);
        $this->call(UserSeeder::class);
    }
}
