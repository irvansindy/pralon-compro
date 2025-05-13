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
        Schema::table('visitor_logs', function (Blueprint $table) {
            $table->string('region')->nullable()->after('country');
            $table->decimal('latitude', 10, 7)->nullable()->after('region');
    $table->decimal('longitude', 10, 7)->nullable()->after('latitude');
            $table->timestamp('visited_at')->useCurrent()->nullable()->after('longitude');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visitor_logs', function (Blueprint $table) {
            $table->dropColumn('region')->after('country');
            $table->dropColumn('visited_at')->after('user_agent');
        });
    }
};
