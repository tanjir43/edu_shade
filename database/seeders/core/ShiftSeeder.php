<?php

namespace Database\Seeders\core;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ShiftSeeder extends Seeder
{
    public function run()
    {
        $schoolId   = 1;
        $branchId   = 1;
        $createdBy  = 1;
        $versionId  = 1;

        $shifts = [
            [
                'name'        => 'Morning Shift',
                'shift_code'  => 'MS',
                'start_time'  => '08:00:00',
                'end_time'    => '12:00:00',
                'school_id'   => $schoolId,
                'branch_id'   => $branchId,
                'version_id'  => $versionId,
                'active_status'=> 1,
                'created_by'  => $createdBy,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],
            [
                'name'        => 'Day Shift',
                'shift_code'  => 'DS',
                'start_time'  => '12:00:00',
                'end_time'    => '16:00:00',
                'school_id'   => $schoolId,
                'branch_id'   => $branchId,
                'version_id'  => $versionId,
                'active_status'=> 1,
                'created_by'  => $createdBy,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],
            [
                'name'        => 'Evening Shift',
                'shift_code'  => 'ES',
                'start_time'  => '16:00:00',
                'end_time'    => '20:00:00',
                'school_id'   => $schoolId,
                'branch_id'   => $branchId,
                'version_id'  => $versionId,
                'active_status'=> 1,
                'created_by'  => $createdBy,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ]
        ];

        DB::table('shifts')->insert($shifts);
    }
}
