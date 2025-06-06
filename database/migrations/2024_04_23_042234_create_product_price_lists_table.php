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
        Schema::create('product_price_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('product_id');
            $table->string('price_list_file')->nullable();
            $table->enum('status', ['active','inactive'])->default('active');
            $table->dateTime('date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_price_lists');
    }
};
