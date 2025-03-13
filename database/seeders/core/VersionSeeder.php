<?php

namespace Database\Seeders\core;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VersionSeeder extends Seeder
{
    public function run()
    {
        $schoolId   = 1;
        $branchId   = 1;
        $createdBy  = 1;

        $versions = [
            [
                'name'          => 'English Medium',
                'code'          => 'EN',
                'description'   => 'Classes conducted in English.',
                'school_id'     => $schoolId,
                'branch_id'     => $branchId,
                'active_status' => 1,
                'created_by'    => $createdBy,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Bengali Medium',
                'code'          => 'HI',
                'description'   => 'Classes conducted in Bangla.',
                'school_id'     => $schoolId,
                'branch_id'     => $branchId,
                'active_status' => 1,
                'created_by'    => $createdBy,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Bilingual Medium',
                'code'          => 'BL',
                'description'   => 'Classes conducted in both English and Bangla.',
                'school_id'     => $schoolId,
                'branch_id'     => $branchId,
                'active_status' => 1,
                'created_by'    => $createdBy,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]
        ];

        DB::table('versions')->insert($versions);
    }
}
