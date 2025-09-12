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
        Schema::table('request_logs', function (Blueprint $table) {
            // lokasi / geo
            if (!Schema::hasColumn('request_logs', 'country')) {
                $table->string('country')->nullable()->after('ip');
            }
            if (!Schema::hasColumn('request_logs', 'city')) {
                $table->string('city')->nullable()->after('country');
            }
            if (!Schema::hasColumn('request_logs', 'state')) {
                $table->string('state')->nullable()->after('city');
            }
            if (!Schema::hasColumn('request_logs', 'timezone')) {
                $table->string('timezone')->nullable()->after('state');
            }
            if (!Schema::hasColumn('request_logs', 'lat')) {
                $table->decimal('lat', 10, 7)->nullable()->after('timezone');
            }
            if (!Schema::hasColumn('request_logs', 'lon')) {
                $table->decimal('lon', 10, 7)->nullable()->after('lat');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('request_logs', function (Blueprint $table) {
            $table->dropColumn(['country','city','state','timezone','lat','lon']);
        });
    }
};
