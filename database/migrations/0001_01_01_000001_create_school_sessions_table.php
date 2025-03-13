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
        Schema::create('school_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200)->index()->comment('e.g., Fall Term, Spring Term');
            $table->string('session_code', 200)->nullable()->unique();
            $table->date('start_date')->index();
            $table->date('end_date')->index();
            $table->tinyInteger('active_status')->default(1)->comment('1 = Active, 0 = Inactive');

            # Foreign Keys with proper constraints
            $table->foreignId('school_id')->constrained()->cascadeOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('academic_year_id')->constrained()->comment('Links session to specific academic year');

            $table->unsignedBigInteger('created_by')->nullable()->index();
            $table->unsignedBigInteger('updated_by')->nullable()->index();
            $table->unsignedBigInteger('deleted_by')->nullable()->index();

            # Timestamps & Soft Deletes
            $table->timestamps();
            $table->softDeletes();

            # Additional indexes for performance
            $table->index(['start_date', 'end_date']);
            $table->index(['school_id', 'academic_year_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_sessions');
    }
};
