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
        Schema::table('log_user_downloads', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->nullable()->after('email');
            $table->enum('type_download', ['brocure', 'pricelist'])->comment('brocure = for history download brocure, pricelist = for history download pricelist')->nullable()
            ->after('product_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('log_user_downloads', function (Blueprint $table) {
            $table->dropColumn('product_id');
            $table->dropColumn('type_download');
        });
    }
};
