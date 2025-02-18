<?php

namespace Database\Seeders\default;

use App\Models\School;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
    */

    public function run(): void
    {
        $schools = [

            'name'              => 'Edu Shade',
            'email'             => 'admin@edushade.com',
            'domain'            => 'edushade',
            'address'           => 'Dhaka, Bangladesh',
            'phone'             => '01700000000',
            'school_code'       => 'EDU-SHADE',
            'is_email_verified' => 1,
            'active_status'     => 1,
            'is_enabled'        => 'yes',
            'created_by'        => 1,
        ];

        School::create($schools);
    }
}
