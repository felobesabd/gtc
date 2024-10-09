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
        Schema::create('job_card_employees', function (Blueprint $table) {
            $table->id();
            $table->integer('job_card_id');
            $table->integer('employee_id');
            $table->decimal('estimated_time_employee', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_card_employees');
    }
};
