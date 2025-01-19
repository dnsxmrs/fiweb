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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number');
            $table->enum('order_type', ['online']);
            $table->decimal('total', 10, 2);
            $table->decimal('tax', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->decimal('delivery_fee', 10, 2);
            $table->enum('status', ['pending', 'preparing', 'ready', 'completed', 'cancelled'])->default('pending'); // pending, processing, completed, cancelled

            $table->string('first_name');
            $table->string('last_name');
            $table->string('contact_number');
            $table->string('email');
            $table->string('region');
            $table->string('province');
            $table->string('municipality');
            $table->string('barangay');
            $table->string('street');
            $table->string('unit')->nullable();
            $table->enum('address_type', ['Residential', 'Office']);
            $table->string('delivery_time');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
