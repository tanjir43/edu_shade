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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200)->index();
            $table->string('subject_code', 50)->nullable()->index();
            $table->text('description')->nullable();
            $table->decimal('theory_marks', 8, 2)->default(0);
            $table->decimal('practical_marks', 8, 2)->default(0);
            $table->decimal('passing_percentage', 5, 2)->default(33);

            # Foreign Keys
            $table->unsignedBigInteger('school_id')->default(1)->index();
            $table->unsignedBigInteger('branch_id')->nullable()->index();

            # Status
            $table->tinyInteger('active_status')->default(1)->comment('1 = Active, 0 = Inactive')->index();

            # User References
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
        Schema::dropIfExists('subjects');
    }
};
