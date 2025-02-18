<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 192)->nullable()->index();
            $table->string('username', 192)->unique()->nullable();
            $table->string('phone_number', 20)->unique()->nullable();
            $table->string('email', 192)->unique()->nullable();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();

            # User Status
            $table->tinyInteger('active_status')->default(1)->index();
            $table->tinyInteger('access_status')->nullable()->default(1);

            # Profile Details
            $table->unsignedBigInteger('language_id')->default(19);
            $table->integer('style_id')->default(1);
            $table->boolean('rtl_ltl')->default(0);     # 0 = LTR, 1 = RTL
            $table->unsignedBigInteger('school_session_id')->default(1);

            # Admin & Verification Status
            $table->enum('is_administrator', ['yes', 'no'])->default('no');
            $table->boolean('is_registered')->default(0);
            $table->boolean('verified')->default(0);

            # Authentication & Security
            $table->text('notification_token')->nullable();
            $table->text('device_token')->nullable();

            $table->rememberToken();

            # Foreign Keys with Proper Indexing
            $table->unsignedBigInteger('role_id')->default(1);
            $table->unsignedBigInteger('school_id')->default(1);
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->unsignedBigInteger('created_by')->default(1);
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            # Indexing
            $table->index(['name', 'email', 'phone_number']);
            $table->timestamps();
            $table->softDeletes();

            # Foreign Keys
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
            $table->foreign('school_session_id')->references('id')->on('school_sessions')->onDelete('cascade');
            $table->foreign('branch_id')->references('id')->on('schools')->onDelete('cascade');
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('set null');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
