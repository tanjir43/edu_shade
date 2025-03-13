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
            $table->foreignId('scl_class_id')->constrained()->cascadeOnDelete()->index();
            $table->foreignId('subject_id')->constrained()->cascadeOnDelete()->index();
            $table->foreignId('school_id')->constrained()->cascadeOnDelete()->index();
            $table->foreignId('branch_id')->nullable()->constrained()->cascadeOnDelete()->index();
            $table->foreignId('academic_year_id')->constrained()->cascadeOnDelete()->index();
            $table->foreignId('version_id')->nullable()->constrained()->cascadeOnDelete()->index();

            # Optional teacher assignment
            $table->foreignId('teacher_id')->nullable()->constrained()->cascadeOnDelete()->index();

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
