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
        Schema::create('item_categories', function (Blueprint $table) {
            $table->id();
            $table->string('item_name');
            $table->integer('category_id');
            $table->integer('group_id');
            $table->string('part_no');
            $table->integer('unit_id');
            $table->integer('quantity');
            $table->decimal('rate')->nullable();
            $table->decimal('rate_per')->nullable();
            $table->integer('min_allowed_value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_categories');
    }
};
