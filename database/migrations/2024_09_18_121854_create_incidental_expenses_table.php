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
        Schema::create('incidental_expenses', function (Blueprint $table) {
            $table->id();
            $table->integer('operation_type')->comment('0=in,1=out');
            $table->text('comments');
            $table->decimal('amount');
            $table->unsignedBigInteger('attachment_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidental_expenses');
    }
};
