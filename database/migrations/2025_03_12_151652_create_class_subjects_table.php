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
        Schema::create('class_subjects', function (Blueprint $table) {
            $table->id();

            # Foreign Keys
            $table->unsignedBigInteger('scl_class_id')->index();
            $table->unsignedBigInteger('subject_id')->index();
            $table->unsignedBigInteger('school_id')->default(1)->index();
            $table->unsignedBigInteger('branch_id')->nullable()->index();
            $table->unsignedBigInteger('academic_year_id')->index();
            $table->unsignedBigInteger('version_id')->nullable()->index();

            # Optional teacher assignment
            $table->unsignedBigInteger('teacher_id')->nullable()->index();

            # Subject details for this class
            $table->decimal('theory_marks', 8, 2)->nullable();
            $table->decimal('practical_marks', 8, 2)->nullable();
            $table->decimal('passing_percentage', 5, 2)->nullable();
            $table->tinyInteger('is_optional')->default(0)->comment('1 = Optional, 0 = Compulsory');

            # Status
            $table->tinyInteger('active_status')->default(1)->comment('1 = Active, 0 = Inactive')->index();

            # User References
            $table->unsignedBigInteger('created_by')->nullable()->index();
            $table->unsignedBigInteger('updated_by')->nullable()->index();
            $table->unsignedBigInteger('deleted_by')->nullable()->index();

            # Indexing for performance
            $table->index(['scl_class_id', 'subject_id']);
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
        Schema::dropIfExists('class_subjects');
    }
};
