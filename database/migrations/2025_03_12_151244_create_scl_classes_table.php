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
        Schema::create('scl_classes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200)->index();
            $table->string('class_code', 50)->nullable();
            $table->unsignedTinyInteger('class_level')->nullable()->comment('Numeric value for sorting');

            # Foreign Keys
            $table->unsignedBigInteger('school_id')->default(1)->index();
            $table->unsignedBigInteger('branch_id')->nullable()->index();
            $table->unsignedBigInteger('version_id')->nullable()->index();
            $table->unsignedBigInteger('shift_id')->nullable()->index();

            # Status
            $table->tinyInteger('active_status')->default(1)->comment('1 = Active, 0 = Inactive')->index();

            # User References
            $table->unsignedBigInteger('created_by')->nullable()->index();
            $table->unsignedBigInteger('updated_by')->nullable()->index();
            $table->unsignedBigInteger('deleted_by')->nullable()->index();

            # Indexing
            $table->index(['school_id', 'branch_id', 'version_id', 'shift_id']);

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
        Schema::dropIfExists('scl_classes');
    }
};
