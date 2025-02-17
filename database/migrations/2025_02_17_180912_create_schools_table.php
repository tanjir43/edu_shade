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
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('name', 250);

            # User References
            $table->unsignedBigInteger('created_by')->default(1);
            $table->unsignedBigInteger('updated_by')->default(1);
            $table->unsignedBigInteger('deleted_by')->nullable();

            # Contact & Identification
            $table->string('email', 200)->nullable()->unique();
            $table->string('domain', 191)->default('school')->unique();
            $table->text('address')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('school_code', 200)->nullable()->unique();

            # Verification & Status
            $table->boolean('is_email_verified')->default(0);
            $table->unsignedTinyInteger('active_status')->default(1)->comment("1 = Approved, 0 = Pending");
            $table->enum('is_enabled', ['yes', 'no'])->default('yes')->comment("yes = Login Enabled, no = Login Disabled");

            # Subscription & Package Details
            $table->date('starting_date')->nullable();
            $table->date('ending_date')->nullable();
            $table->unsignedBigInteger('package_id')->nullable();
            $table->string('plan_type', 200)->nullable();
            $table->unsignedInteger('region')->nullable();
            $table->enum('contact_type', ['yearly', 'monthly', 'once'])->nullable();


            # Timestamps & Soft Deletes
            $table->timestamps();
            $table->softDeletes();

            # Indexing
            $table->index(['email', 'domain', 'school_code']);
            $table->index('package_id');
            $table->index('region');

            # Foreign Keys
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
    */
    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};
