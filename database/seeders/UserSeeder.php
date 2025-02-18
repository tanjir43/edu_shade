<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
    */

    public function run(): void
    {
        $users = [
            'name'              => 'Super Admin',
            'username'          => 'superadmin',
            'phone_number'      => '01700000000',
            'email'             => 'admin@edushade.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('12345678'),
            'is_administrator'  => 'yes',
            'verified'          => 1,
            'role_id'           => 1,
            'school_id'         => 1,
            'active_status'     => 1,
            'school_session_id' => 1,
        ];

        User::create($users);
    }
}
