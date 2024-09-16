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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('chassis_no');
            $table->string('machine_no');
            $table->string('gearbox_no');
            $table->string('vehicle_type');
            $table->string('color');
            $table->integer('capacity');
            $table->integer('group_id');
            $table->integer('category_id');
            $table->string('license_no');
            $table->string('plate_no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
