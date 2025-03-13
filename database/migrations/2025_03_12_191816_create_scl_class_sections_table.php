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
            $table->unsignedBigInteger('scl_class_id')->index();
            $table->unsignedBigInteger('section_id')->index();
            $table->unsignedBigInteger('school_id')->default(1)->index();
            $table->unsignedBigInteger('branch_id')->nullable()->index();
            $table->unsignedBigInteger('academic_year_id')->index();

            $table->tinyInteger('active_status')->default(1)->comment('1 = Active, 0 = Inactive')->index();

            $table->index(['scl_class_id', 'section_id'], 'class_section_index');
            $table->index(['scl_class_id', 'school_id', 'branch_id', 'academic_year_id'], 'class_school_branch_year_index');

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
