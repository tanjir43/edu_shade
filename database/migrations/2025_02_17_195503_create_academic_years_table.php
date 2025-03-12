<?php

use App\Models\AcademicYear;
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
        Schema::create('academic_years', function (Blueprint $table) {
            $table->id();
            $table->string('year', 255)->index();
            $table->string('title', 255)->index();
            $table->date('starting_date')->index();
            $table->date('ending_date')->index();
            $table->string('copied_from_academic_year')->nullable();
            $table->tinyInteger('active_status')->default(1)->index();

            # User References
            $table->unsignedBigInteger('school_id')->default(1)->index();
            $table->unsignedBigInteger('branch_id')->nullable()->index();

            $table->index(['starting_date', 'ending_date']);
            $table->index(['school_id', 'branch_id']);

            $table->unsignedBigInteger('created_by')->default(1);
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            # Timestamps & Soft Deletes
            $table->timestamps();
            $table->softDeletes();
        });

        $year = date('Y');

        $academicYear = new AcademicYear([
            'year'          => $year,
            'title'         => 'Jan-Dec',
            'starting_date' => "$year-01-01",
            'ending_date'   => "$year-12-30",
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        $academicYear->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_years');
    }
};
