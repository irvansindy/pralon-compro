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
        Schema::table('subcriptions', function (Blueprint $table) {
            $table->string('verification_token')->nullable()->unique()->after('is_verified');
            $table->timestamp('verified_at')->nullable()->after('referrer');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subcriptions', function (Blueprint $table) {
            $table->dropColumn('verification_token')->after('is_verified');
            $table->dropColumn('verified_at')->after('referrer');
        });
    }
};
