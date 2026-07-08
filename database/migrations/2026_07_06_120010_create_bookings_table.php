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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('item_name');
            $table->foreignId('category_id')->constrained();
            $table->string('method');
            $table->json('tracking');
            $table->integer('total_carton');
            $table->integer('total_quantity');
            $table->decimal('total_weight', 8, 2);
            $table->boolean('sensitive_goods')->default(false);
            $table->string('delivery_method');
            $table->foreignId('district_id')->constrained();
            $table->text('address');
            $table->text('note')->nullable();
            $table->string('status')->default('pending'); // pending, received, processing, shipped, delivered, cancelled
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
