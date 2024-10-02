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
        Schema::create('privileges', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('page_name');
            $table->integer('show_action')->default(0)->comment('0=no,1=yes');
            $table->integer('add_action')->default(0)->comment('0=no,1=yes');
            $table->integer('edit_action')->default(0)->comment('0=no,1=yes');
            $table->integer('delete_action')->default(0)->comment('0=no,1=yes');
            $table->text('additional_permissions')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('privileges');
    }
};
