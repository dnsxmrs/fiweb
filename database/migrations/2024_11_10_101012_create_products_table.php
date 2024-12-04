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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Primary key for product
            $table->string('name'); // Product name (e.g., Iced Coffee)
            $table->text('description')->nullable(); // Nullable product description
            $table->decimal('price', 10, 2); // Product price with decimal precision
            $table->boolean('isAvailable')->default(true); // Availability flag (default: true)
            $table->boolean('has_customization')->default(false); // Customization flag (default: false)
            $table->string('image')->nullable(); // Nullable image for the product
            $table->integer('category_number')->nullable(); // Foreign key to category
            $table->timestamps(); // Timestamps for created_at and updated_at
            $table->softDeletes(); // Soft delete column

            // Foreign key constraint linking product to category
            $table->foreign('category_number')->references('category_number')->on('categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
