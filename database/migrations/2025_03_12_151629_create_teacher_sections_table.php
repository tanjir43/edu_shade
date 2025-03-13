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
            $table->foreignId('teacher_id')->constrained()->cascadeOnDelete()->index();
            $table->foreignId('scl_class_id')->constrained()->cascadeOnDelete()->index();
            $table->foreignId('section_id')->constrained()->cascadeOnDelete()->index();
            $table->foreignId('subject_id')->nullable()->constrained()->cascadeOnDelete()->index();
            $table->foreignId('school_id')->constrained()->cascadeOnDelete()->index();
            $table->foreignId('branch_id')->nullable()->constrained()->cascadeOnDelete()->index();
            $table->foreignId('academic_year_id')->constrained()->cascadeOnDelete()->index();
            $table->foreignId('version_id')->nullable()->constrained()->cascadeOnDelete()->index();
            $table->foreignId('shift_id')->nullable()->constrained()->cascadeOnDelete()->index();

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
