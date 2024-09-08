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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('department_id');
            $table->text('passport_image')->nullable();
            $table->text('personal_card_image')->nullable();
            $table->string('passport_no');
            $table->string('civil_no');
            $table->string('bank_acc_no');
            $table->string('bank_name');
            $table->string('country');
            $table->timestamp('joining_date');
            $table->timestamp('date_of_birth');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
