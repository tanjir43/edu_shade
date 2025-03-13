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
        Schema::create('teacher_sections', function (Blueprint $table) {
            $table->id();

            # Foreign Keys
            $table->unsignedBigInteger('teacher_id')->index();
            $table->unsignedBigInteger('scl_class_id')->index();
            $table->unsignedBigInteger('section_id')->index();
            $table->unsignedBigInteger('subject_id')->nullable()->index();
            $table->unsignedBigInteger('school_id')->default(1)->index();
            $table->unsignedBigInteger('branch_id')->nullable()->index();
            $table->unsignedBigInteger('academic_year_id')->index();
            $table->unsignedBigInteger('version_id')->nullable()->index();
            $table->unsignedBigInteger('shift_id')->nullable()->index();

            # Is class teacher
            $table->tinyInteger('is_class_teacher')->default(0)->comment('1 = Yes, 0 = No');

            # Status
            $table->tinyInteger('active_status')->default(1)->comment('1 = Active, 0 = Inactive')->index();

            # User References
            $table->unsignedBigInteger('created_by')->nullable()->index();
            $table->unsignedBigInteger('updated_by')->nullable()->index();
            $table->unsignedBigInteger('deleted_by')->nullable()->index();

            # Indexing for performance
            $table->index(['teacher_id', 'scl_class_id', 'section_id']);
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
        Schema::dropIfExists('teacher_sections');
    }
};
