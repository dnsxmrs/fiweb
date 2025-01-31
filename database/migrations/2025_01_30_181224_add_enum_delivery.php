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
        // Add enum 'delivery' to the orders status column with a default value of 'pending'
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('status', ['pending', 'preparing', 'ready', 'delivery', 'completed', 'cancelled'])
                    ->default('pending')  // Set 'pending' as the default value
                    ->change();
        });
    }

    public function down(): void
    {
        // Revert back by removing 'delivery' from the orders status column
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('status', ['pending', 'preparing', 'ready', 'completed', 'cancelled'])
                    ->default('pending')  // Set 'pending' as the default value
                    ->change();
        });
    }
};
