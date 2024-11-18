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
        Schema::create('sub_menus', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('menu_id');
            $table->string('name')->nullable();
            $table->string('url')->nullable();
            $table->string('slug')->nullable();
            $table->string('icon')->nullable();
            $table->enum('active', [1,0])->nullable()->default(1);
            $table->integer('ordering')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_menus');
    }
};
