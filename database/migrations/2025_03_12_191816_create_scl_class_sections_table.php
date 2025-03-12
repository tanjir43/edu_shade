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
        Schema::create('scl_class_sections', function (Blueprint $table) {
            $table->id();

            # Foreign Keys
            $table->foreignId('scl_class_id')->constrained()->cascadeOnDelete()->index();
            $table->foreignId('section_id')->constrained()->cascadeOnDelete()->index();
            $table->foreignId('school_id')->constrained()->cascadeOnDelete()->index();
            $table->foreignId('branch_id')->nullable()->constrained()->cascadeOnDelete()->index();
            $table->foreignId('academic_year_id')->constrained()->cascadeOnDelete()->index();

            $table->tinyInteger('active_status')->default(1)->comment('1 = Active, 0 = Inactive')->index();

            $table->index(['scl_class_id', 'section_id']);
            $table->index(['scl_class_id', 'school_id', 'branch_id', 'academic_year_id']);

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
        Schema::dropIfExists('scl_class_sections');
    }
};
