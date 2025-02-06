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
        Schema::table('contact_us', function (Blueprint $table) {
            $table->dropColumn(['address', 'fax', 'image']);
            $table->string('type')->nullable()->after('phone_number');
            $table->longText('message')->nullable()->after('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_us', function (Blueprint $table) {
            $table->longText('address')->nullable();
            $table->string('fax')->nullable();
            $table->string('image')->nullable();
            $table->dropColumn('type')->after('phone_number');
            $table->dropColumn('message')->after('type');
        });
    }
};
