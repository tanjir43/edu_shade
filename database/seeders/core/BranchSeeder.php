<?php

namespace Database\Seeders\core;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
    */
    public function run()
    {
        $schoolId   = 1;
        $createdBy  = 1;

        $branches = [
            [
                'name'          => 'Main Campus',
                'branch_code'   => 'BRANCH-001',
                'email'         => 'main@school.com',
                'phone'         => '123-456-7890',
                'address'       => '123 Main St, City, Country',
                'active_status' => 1,
                'school_id'     => $schoolId,
                'created_by'    => $createdBy,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'West Campus',
                'branch_code'   => 'BRANCH-002',
                'email'         => 'west@school.com',
                'phone'         => '098-765-4321',
                'address'       => '456 West St, City, Country',
                'active_status' => 1,
                'school_id'     => $schoolId,
                'created_by'    => $createdBy,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'East Campus',
                'branch_code'   => 'BRANCH-003',
                'email'         => 'east@school.com',
                'phone'         => '555-123-4567',
                'address'       => '789 East St, City, Country',
                'active_status' => 1,
                'school_id'     => $schoolId,
                'created_by'    => $createdBy,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ];

        DB::table('branches')->insert($branches);
    }
}
