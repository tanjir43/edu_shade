<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
    */
    public function up(): void
    {
        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        $data = [
            ['key' => 'site_name', 'value' => 'Edu Shade'],
            ['key' => 'is_rabbitmq_enable', 'value' => false],
            ['key' => 'twilio_is_send_otp', 'value' => false],
            ['key' => 'otp_expiration', 'value' => 5], # 5 minutes
            ['key' => 'is_check_suspicious', 'value' => false],
            ['key' => 'is_send_suspicious_by_mail', 'value' => false],
            ['key' => 'is_enable_sentry', 'value' => true],
            ['key' => 'frontend_language', 'value' => 'de'],
            ['key' => 'alert_type', 'value' => 'toastr'], # sweetalert
            ['key' => 'is_mantain_branch', 'value' => false], # branch
            ['key' => 'is_mantain_version', 'value' => false], # version
            ['key' => 'is_mantain_shift', 'value' => false], # shift
        ];

        DB::table('system_settings')->insert($data);
    }
    /**
     * Reverse the migrations.
    */
    public function down(): void
    {
        Schema::dropIfExists('system_settings');
    }
};
