<?php

namespace Database\Seeders\core;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ClassSeeder extends Seeder
{
    public function run()
    {
        $schoolId   = 1;
        $branchId   = 1;
        $createdBy  = 1;
        $versionId  = 1;
        $shiftId    = 1;

        $classes = [
            [
                'name'          => 'Class 1',
                'class_code'    => 'C1',
                'class_level'   => 1,
                'school_id'     => $schoolId,
                'branch_id'     => $branchId,
                'version_id'    => $versionId,
                'shift_id'      => $shiftId,
                'active_status' => 1,
                'created_by'    => $createdBy,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Class 2',
                'class_code'    => 'C2',
                'class_level'   => 2,
                'school_id'     => $schoolId,
                'branch_id'     => $branchId,
                'version_id'    => $versionId,
                'shift_id'      => $shiftId,
                'active_status' => 1,
                'created_by'    => $createdBy,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Class 3',
                'class_code'    => 'C3',
                'class_level'   => 3,
                'school_id'     => $schoolId,
                'branch_id'     => $branchId,
                'version_id'    => $versionId,
                'shift_id'      => $shiftId,
                'active_status' => 1,
                'created_by'    => $createdBy,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]
        ];

        DB::table('scl_classes')->insert($classes);
    }
}
