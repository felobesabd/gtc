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
        Schema::create('item_transaction', function (Blueprint $table) {
            $table->id();
            $table->integer('item_id');
            $table->integer('quantity');
            $table->text('reason');
            $table->decimal('cost', 10, 2);
            $table->decimal('price', 10, 2);
            $table->integer('transaction_type')->comment('1=in,2=out');
            $table->integer('supplier_id');
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_transaction');
    }
};
