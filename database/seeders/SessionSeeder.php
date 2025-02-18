<?php

namespace Database\Seeders;

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

            'school_id'     => 1,
            'branch_id'     => 1,
            'name'          => '2021-2022',
            'session_code'  => '2021-2022',
            'active_status' => 1,
            'created_by'    => 1,

        ];

        SchoolSession::create($sessions);
    }
}
