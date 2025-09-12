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
        Schema::create('news_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('news_id');
            $table->string('locale', 5); // 'id', 'en', dll
            $table->string('title');
            $table->longText('short_desc');
            $table->longText('header_content');
            $table->longText('content');
            $table->timestamps();
            
            $table->unique(['news_id', 'locale']); // satu news hanya boleh 1 terjemahan per bahasa
            $table->foreign('news_id')->references('id')->on('news')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_translations');
    }
};
