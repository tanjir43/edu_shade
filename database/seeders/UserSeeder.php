<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
    */

    public function run(): void
    {
        $users = [

            'name'              => 'Edu Shade',
            'email'             => 'admin@edushade.com',
            'domain'            => 'edushade',
            'address'           => 'Dhaka, Bangladesh',
            'phone'             => '01700000000',
            'school_code'       => 'EDU-SHADE',
            'is_email_verified' => 1,
            'active_status'     => 1,
            'is_enabled'        => 'yes',
            'starting_date'     => now(),
            'created_by'        => 1,
        ];

        User::create($users);
    }
}
