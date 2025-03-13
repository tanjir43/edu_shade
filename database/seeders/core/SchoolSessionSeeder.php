<?php

namespace Database\Seeders\core;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SchoolSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
    */

    public function run()
    {
        $schoolId       = 1;
        $branchId       = null;
        $academicYearId = 1;
        $createdBy      = 1;

        $sessions = [
            [
                'name'             => 'Fall Term 2024',
                'session_code'     => 'FALL-2024',
                'start_date'       => '2024-09-01',
                'end_date'         => '2024-12-15',
                'active_status'    => 1,
                'school_id'        => $schoolId,
                'branch_id'        => $branchId,
                'academic_year_id' => $academicYearId,
                'created_by'       => $createdBy,
                'created_at'       => Carbon::now(),
                'updated_at'       => Carbon::now(),
            ],
            [
                'name'             => 'Spring Term 2025',
                'session_code'     => 'SPRING-2025',
                'start_date'       => '2025-01-10',
                'end_date'         => '2025-05-20',
                'active_status'    => 1,
                'school_id'        => $schoolId,
                'branch_id'        => $branchId,
                'academic_year_id' => $academicYearId,
                'created_by'       => $createdBy,
                'created_at'       => Carbon::now(),
                'updated_at'       => Carbon::now(),
            ],
            [
                'name'             => 'Summer Term 2025',
                'session_code'     => 'SUMMER-2025',
                'start_date'       => '2025-06-15',
                'end_date'         => '2025-08-30',
                'active_status'    => 1,
                'school_id'        => $schoolId,
                'branch_id'        => $branchId,
                'academic_year_id' => $academicYearId,
                'created_by'       => $createdBy,
                'created_at'       => Carbon::now(),
                'updated_at'       => Carbon::now(),
            ],
        ];

        DB::table('school_sessions')->insert($sessions);
    }
}
