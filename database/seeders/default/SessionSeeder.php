<?php

namespace Database\Seeders\default;

use App\Models\SchoolSession;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sessions = [
            'school_id'         => 1,
            'name'              => '2025-2026',
            'session_code'      => '2025-2026',
            'start_date'        => '2025-01-01',
            'end_date'          => '2026-12-31',
            'academic_year_id'  => 1,
            'active_status'     => 1,
            'created_by'        => 1,
        ];

        SchoolSession::create($sessions);
    }
}
