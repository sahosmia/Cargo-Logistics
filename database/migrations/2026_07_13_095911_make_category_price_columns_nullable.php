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
        Schema::table('categories', function (Blueprint $table) {
            $table->decimal('sea_price_start', 10, 2)->nullable()->change();
            $table->decimal('sea_price_end', 10, 2)->nullable()->change();
            $table->decimal('air_price_start', 10, 2)->nullable()->change();
            $table->decimal('air_price_end', 10, 2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->decimal('sea_price_start', 10, 2)->nullable(false)->change();
            $table->decimal('sea_price_end', 10, 2)->nullable(false)->change();
            $table->decimal('air_price_start', 10, 2)->nullable(false)->change();
            $table->decimal('air_price_end', 10, 2)->nullable(false)->change();
        });
    }
};
