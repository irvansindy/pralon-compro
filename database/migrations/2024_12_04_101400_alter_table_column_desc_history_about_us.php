<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('history_about_us', function (Blueprint $table) {
            // DB::statement("ALTER TABLE `history_about_us` MODIFY `DESC` longtext NOT NULL");
            $table->longText('desc')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('history_about_us', function (Blueprint $table) {
            // DB::statement("ALTER TABLE `history_about_us` MODIFY `DESC` varchar(255) NOT NULL");
            $table->string('desc', 255)->change();
        });
    }
};
