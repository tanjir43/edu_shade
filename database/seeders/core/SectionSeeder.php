<?php

namespace Database\Seeders\core;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SectionSeeder extends Seeder
{
    public function run()
    {
        $schoolId   = 1;
        $branchId   = 1;
        $createdBy  = 1;

        $sections = [
            [
                'name'          => 'Section A',
                'section_code'  => 'A1',
                'capacity'      => 30,
                'school_id'     => $schoolId,
                'branch_id'     => $branchId,
                'active_status' => 1,
                'created_by'    => $createdBy,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Section B',
                'section_code'  => 'B1',
                'capacity'      => 35,
                'school_id'     => $schoolId,
                'branch_id'     => $branchId,
                'active_status' => 1,
                'created_by'    => $createdBy,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Section C',
                'section_code'  => 'C1',
                'capacity'      => 25,
                'school_id'     => $schoolId,
                'branch_id'     => $branchId,
                'active_status' => 1,
                'created_by'    => $createdBy,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]
        ];

        DB::table('sections')->insert($sections);
    }
}
