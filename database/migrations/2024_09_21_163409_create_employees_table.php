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
            $table->string('email');
            $table->string('direct_contact_number');
            $table->string('whatsapp_number');
            $table->string('country_contact_number');
            $table->string('country_code');
            $table->string('social_url');
            $table->integer('department_id');
            $table->text('attachments_ids')->nullable();
            $table->string('passport_no');
            $table->string('civil_no');
            $table->string('bank_acc_no');
            $table->string('bank_name');
            $table->string('country');
            $table->date('joining_date');
            $table->date('date_of_birth');
            $table->date('passport_issued_at');
            $table->date('passport_expires_at');
            $table->date('driving_license_issued_at');
            $table->date('driving_license_expires_at');
            $table->string('medical_insurance_no')->nullable();
            $table->date('medical_issued_at')->nullable();
            $table->date('medical_expires_at')->nullable();
            $table->string('life_insurance_no')->nullable();
            $table->date('life_issued_at')->nullable();
            $table->date('life_expires_at')->nullable();
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
