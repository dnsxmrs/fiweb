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
        Schema::create('categories', function (Blueprint $table) {
            $table->id('category_id'); // Primary key
            $table->integer('category_number')->unique(); // Category number (e.g., 1, 2, 3)
            $table->string('name')->unique(); // Category name (e.g., Food, Beverage)
            $table->enum('type', ['food', 'beverage']); // Type of category: Food or Beverage
            $table->enum('beverage_type', ['hot', 'iced'])->nullable(); // Beverage type (only for beverages)
            $table->string('image')->nullable(); // Optional image for category
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
