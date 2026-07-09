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
        Schema::table('bookings', function (Blueprint $table) {
            $table->decimal('unit_price', 10, 2)->nullable()->after('total_weight');
            $table->decimal('total_price', 10, 2)->nullable()->after('unit_price');
            $table->string('payment_status')->default('pending')->after('status'); // pending, paid
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['unit_price', 'total_price', 'payment_status']);
        });
    }
};
