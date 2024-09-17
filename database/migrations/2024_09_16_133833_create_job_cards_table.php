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
        Schema::create('job_cards', function (Blueprint $table) {
            $table->id();
            $table->integer('vehicle_id');
            $table->string('delivered_by');
            $table->string('received_by');
            $table->string('ref_number');
            $table->date('date_in');
            $table->date('expected_date_out');
            $table->string('reg_no');
            $table->integer('km');
            $table->integer('expected_hour_out');
            $table->string('location');
            $table->integer('site')->comment('1=reactive,2=proactive');
            $table->integer('job_card_type')->comment('1=internal,2=breakdown,3=dealerService,4=insurance,5=outsideGarage');
            $table->integer('repair_type')->comment('1=normal,2=accident,3=major,4=pms,5=safety,6=warranty,7=repetitive');
            $table->text('work_required')->nullable();
            $table->string('estimated_time');
            $table->text('staff_details')->nullable();
            $table->text('comments')->nullable();
            $table->decimal('lubrication_cost', 10, 2);
            $table->decimal('subcontractor_cost', 10, 2);
            $table->decimal('parts_cost', 10, 2);
            $table->decimal('total_cost', 10, 2)->nullable();
            $table->integer('driver_id');
            $table->string('operation_coordinator');
            $table->string('maintenance_supervisor');
            $table->string('maintenance_manager');
            $table->string('part_number');
            $table->text('description');
            $table->decimal('cost', 10, 2);
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_cards');
    }
};
