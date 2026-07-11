<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('bookings')->where('status', 'received')->update(['status' => 'received_in_china']);
        DB::table('bookings')->where('status', 'processing')->update(['status' => 'in_transit']);
        DB::table('bookings')->where('status', 'shipped')->update(['status' => 'arrived_in_bd']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('bookings')->where('status', 'received_in_china')->update(['status' => 'received']);
        DB::table('bookings')->where('status', 'in_transit')->update(['status' => 'processing']);
        DB::table('bookings')->where('status', 'arrived_in_bd')->update(['status' => 'shipped']);
    }
};
