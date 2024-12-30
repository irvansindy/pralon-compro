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
        Schema::create('detail_why_pralon_about_us', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('history_about_us_id');
            $table->string('title')->nullable();
            $table->string('desc')->nullable();
            $table->string('icon')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_why_pralon_about_us');
    }
};
