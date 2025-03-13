<?php

namespace Database\Seeders\core;

use App\Models\School;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
    */

    public function run(): void
    {
        $school = [
            'name'              => 'Edu Shade',
            'email'             => 'admin@edushade.com',
            'domain'            => 'edushade',
            'school_code'       => 'EDU-SHADE',
            'address'           => 'Dhaka, Bangladesh',
            'phone'             => '01700000000',
            'is_email_verified' => 1,
            'active_status'     => 1,
            'is_enabled'        => 'yes',
            'created_by'        => 1,
        ];

        School::create($school);
    }
}
