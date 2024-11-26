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
            $table->id(); // Primary key column with unique, auto-incremented ID
            $table->string('product_name'); // Unique name for each product
            $table->text('product_description')->nullable(); // Nullable description
            $table->decimal('product_price', 8, 2); // Price with 2 decimal places
            $table->unsignedBigInteger('category_id')->nullable(); // Nullable foreign key to category
            $table->boolean('isAvailable')->default(true); // Availability defaulting to true
            $table->string('image')->nullable(); // Nullable path to image
            $table->timestamps();

            // Foreign key constraint for category_id
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('set null');
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
