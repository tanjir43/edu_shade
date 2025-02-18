<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
    */
    public function run(): void
    {
        $roles = [
            'Super admin',
            'Admin',
            'Teacher',
            'Student',
            'Parents',
            'Accountant',
            'Receptionist',
            'Librarian',
            'Driver',
            'Alumni',
            "Hostel manager",
            "Medical officer",
            "IT administrator",
            "Sports coach",
            "Lab Assistant"
        ];

        foreach ($roles as $roleName) {
            Role::updateOrCreate(
                [
                    'name' => $roleName,
                    'school_id' => 1,
                ],
                [
                    'type'       => 'system',
                    'created_at' => Carbon::now(),
                ]
            );
        }
    }
}
