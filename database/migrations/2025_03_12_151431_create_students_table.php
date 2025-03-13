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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->string('student_code', 50)->nullable()->index();
            $table->string('roll_number', 50)->nullable();
            $table->string('email', 191)->nullable();
            $table->string('phone', 20)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('gender', 20)->nullable();
            $table->text('address')->nullable();
            $table->string('photo', 191)->nullable();

            # Foreign Keys
            $table->foreignId('school_id')->constrained()->cascadeOnDelete()->index();
            $table->foreignId('branch_id')->nullable()->constrained()->cascadeOnDelete()->index();
            $table->foreignId('academic_year_id')->constrained()->cascadeOnDelete()->index();
            $table->foreignId('scl_class_id')->constrained()->cascadeOnDelete()->index();
            $table->foreignId('section_id')->constrained()->cascadeOnDelete()->index();
            $table->foreignId('version_id')->nullable()->constrained()->cascadeOnDelete()->index();
            $table->foreignId('shift_id')->nullable()->constrained()->cascadeOnDelete()->index();

            # Status
            $table->tinyInteger('active_status')->default(1)->comment('1 = Active, 0 = Inactive')->index();

            # User References
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->unsignedBigInteger('created_by')->nullable()->index();
            $table->unsignedBigInteger('updated_by')->nullable()->index();
            $table->unsignedBigInteger('deleted_by')->nullable()->index();

            # Indexing for performance
            $table->index(['scl_class_id', 'section_id', 'academic_year_id']);
            $table->index(['school_id', 'branch_id', 'academic_year_id']);

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
        Schema::dropIfExists('students');
    }
};
