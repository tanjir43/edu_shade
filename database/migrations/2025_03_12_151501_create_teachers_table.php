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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->string('teacher_code', 50)->nullable()->index();
            $table->string('email', 191)->nullable()->unique();
            $table->string('phone', 20)->nullable();
            $table->text('address')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->date('joining_date')->nullable();
            $table->string('qualification', 191)->nullable();
            $table->string('photo', 191)->nullable();

            # Foreign Keys
            $table->foreignId('school_id')->constrained()->cascadeOnDelete()->index();
            $table->foreignId('branch_id')->nullable()->constrained()->cascadeOnDelete()->index();

            # Status
            $table->tinyInteger('active_status')->default(1)->comment('1 = Active, 0 = Inactive')->index();

            # User References
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->unsignedBigInteger('created_by')->nullable()->index();
            $table->unsignedBigInteger('updated_by')->nullable()->index();
            $table->unsignedBigInteger('deleted_by')->nullable()->index();

            # Timestamps & Soft Deletes
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
