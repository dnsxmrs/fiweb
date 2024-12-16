<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class WebhookController extends Controller
{
    // testing api calls
    public function updateProduct(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|integer',
            'name' => 'required|string',
            'price' => 'required|decimal:2',
            'category_id' => 'required|integer',
            'image' => 'nullable|string',
        ]);

        // Find and update or create the product
        Product::updateOrCreate(
            ['id' => $validatedData['product_id']],
            $validatedData
        );

        return response()->json(['message' => 'Product updated successfully']);
    }
    public function updateCategory(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|integer',
            'category_name' => 'required|string',
            'image_url' => 'nullable|string',
        ]);

        // Find and update or create the category
        Category::updateOrCreate(
            ['id' => $validatedData['category_id']],
            $validatedData
        );

        return response()->json(['message' => 'Category updated successfully']);
    }

    // used in POS - creating and updating categories
    public function upCategory(Request $request)
    {
        // log incoming request
        \Log::info('Received upCategory request', [
            'request_method' => $request->method(),
            'request_data' => $request->all()
        ]);

        // Determine the request method
        $method = $request->method();

        if ($method === 'DELETE') {
            return $this->deleteCategory($request);
        }

        // Validate the incoming request data
        $validatedData = $request->validate([
            'category_number' => 'required|integer', // Ensure the category exists
            'category_name' => 'required|string|max:255', // Category name should not exceed 255 chars
            'type' => 'required|string|max:255', // Validate category type (e.g., food, beverage)
            'beverage_type' => 'nullable|string|max:255', // Optional, e.g., hot, iced
            'image_url' => 'nullable|string|url', // Ensure the image_url is a valid URL if provided
        ]);

        try {
            // Check if category exists by category_number
            $category = Category::where('category_number', $validatedData['category_number'])->first();

            if ($category) {
                // Update the existing category
                $category->update([
                    'name' => $validatedData['category_name'],
                    'type' => $validatedData['type'],
                    'beverage_type' => $validatedData['beverage_type'] ?? null,
                    'image' => $validatedData['image_url'] ?: null, // Treat empty string as null
                ]);

                \Log::info('Category updated successfully', [
                    'category_number' => $category->category_number,
                    'name' => $category->name,
                    'type' => $category->type,
                    'beverage_type' => $category->beverage_type,
                    'image' => $category->image,
                ]);

                // Return success response for update
                return response()->json([
                    'status' => 'success',
                    'message' => 'Category updated successfully!',
                    'category' => $category,
                ], 200);
            } else {
                // Create a new category if it doesn't exist
                $category = Category::create([
                    'category_number' => $validatedData['category_number'],
                    'name' => $validatedData['category_name'],
                    'type' => $validatedData['type'],
                    'beverage_type' => $validatedData['beverage_type'] ?? null,
                    'image' => $validatedData['image_url'] ?: null,
                ]);

                \Log::info('Category created successfully', [
                    'category_number' => $category->category_number,
                    'name' => $category->name,
                    'type' => $category->type,
                    'beverage_type' => $category->beverage_type,
                    'image' => $category->image,
                ]);

                // Return success response for creation
                return response()->json([
                    'status' => 'success',
                    'message' => 'Category created successfully!',
                    'category' => $category,
                ], 201);
            }
        } catch (\Exception $e) {
            // Log the error with relevant context
            \Log::error('Failed to process category operation', [
                'error' => $e->getMessage(),
                'data' => $validatedData,
            ]);

            // Return failure response
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to process category operation.',
                'error_details' => $e->getMessage(),
            ], 500);    
        }
    }

    // referenced in upCategory method - deleting a category
    protected function deleteCategory(Request $request)
    {
        $validatedData = $request->validate([
            'category_number' => 'required|integer', // Ensure the category_number is provided
        ]);

        try {
            $category = Category::where('category_number', $validatedData['category_number'])->first();

            if (!$category) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Category not found.',
                ], 404);
            }

            $category->delete();

            \Log::info('Category deleted successfully', [
                'category_number' => $validatedData['category_number'],
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Category deleted successfully!',
                'category_number' => $validatedData['category_number'],
            ], 200);
        } catch (\Exception $e) {
            \Log::error('Failed to delete category', [
                'error' => $e->getMessage(),
                'category_number' => $validatedData['category_number'],
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete category.',
                'error_details' => $e->getMessage(),
            ], 500);
        }
    }

    // used in POS - creating and updating products
    public function upProduct(Request $request)
    {
        // Log the incoming request data for debugging
        \Log::info('Received upProduct request', [
            'request_data' => $request->all()
        ]);

        // Determine the request method
        $method = $request->method();

        if ($method === 'DELETE') {
            return $this->deleteProduct($request);
        }

        // Validate incoming request data
        $validatedData = $request->validate([
            'product_id' => 'required|integer', // Ensure the product_id is provided
            'name' => 'required|string|max:255', // Ensure the name is required and not too long
            'description' => 'nullable|string|max:1000', // Allow null, limit description length to avoid overly large data
            'price' => 'required|numeric|between:0,999999.99', // Ensure the price is numeric and within a reasonable range
            'isAvailable' => 'required|boolean', // Ensure availability is explicitly set to true/false
            'has_customization' => 'required|boolean', // Ensure customization flag is explicitly set
            'image' => 'nullable|string|max:2048', // Validate image file if provided, limit size to 2MB
            'category_number' => 'nullable|integer|exists:categories,category_number', // Ensure category exists if provided
        ]);

        try {
            // Check if product exists by product_id
            $product = Product::where('id', $validatedData['product_id'])->first();

            if ($product) {
                // Category exists, update the record
                $product->update([
                    'name' => $validatedData['name'],  // Ensure the name is updated
                    'description' => $validatedData['description'] ?? null,  // Treat empty string as null
                    'price' => $validatedData['price'],  // Ensure the price is updated
                    'isAvailable' => $validatedData['isAvailable'],  // Ensure the availability is updated
                    'has_customization' => $validatedData['has_customization'],  // Ensure the customization flag is updated
                    'image' => $validatedData['image'] ?: null,  // Treat empty string as null
                    'category_number' => $validatedData['category_number'] ?? null,  // Treat empty string as null
                ]);

                // Log the successful category update
                \Log::info('Product updated successfully', [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'description' => $product->description,
                    'price' => $product->price,
                    'isAvailable' => $product->isAvailable,
                    'has_customization' => $product->has_customization,
                    'image' => $product->image,
                    'category_number' => $product->category_number,
                ]);

                // Return a response indicating success
                return response()->json([
                    'message' => 'Product updated successfully!',
                    'product' => $product
                ]);
            } else {
                // Category does not exist, create a new record
                $product = Product::create([
                    'name' => $validatedData['name'],
                    'description' => $validatedData['description'] ?? null,
                    'price' => $validatedData['price'],
                    'isAvailable' => $validatedData['isAvailable'],
                    'has_customization' => $validatedData['has_customization'],
                    'image' => $validatedData['image'] ?: null,
                    'category_number' => $validatedData['category_number'] ?? null,
                ]);

                // Log the successful category create
                \Log::info('Product created successfully', [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'description' => $product->description,
                    'price' => $product->price,
                    'isAvailable' => $product->isAvailable,
                    'has_customization' => $product->has_customization,
                    'image' => $product->image,
                    'category_number' => $product->category_number,
                ]);

                // Return a response indicating success
                return response()->json([
                    'message' => 'Product created successfully!',
                    'product' => $product
                ]);
            }
        } catch (\Exception $e) {
            // Log the error with relevant context
            \Log::error('Failed to process product operation', [
                'error' => $e->getMessage(),
                'data' => $validatedData,
            ]);

            // Return failure response
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to process product operation.',
                'error_details' => $e->getMessage(),
            ], 500);
        }
    }

    // referenced in upProduct method - deleting a product
    protected function deleteProduct(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|integer', // Ensure the category_number is provided
        ]);

        try {
            $product = Product::where('id', $validatedData['product_id'])->first();

            if (!$product) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Product not found.',
                ], 404);
            }

            $product->delete();

            \Log::info('Product deleted successfully', [
                'product_id' => $validatedData['product_id'],
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Product deleted successfully!',
                'product_id' => $validatedData['product_id'],
            ], 200);
        } catch (\Exception $e) {
            \Log::error('Failed to delete product', [
                'error' => $e->getMessage(),
                'product_id' => $validatedData['product_id'],
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete product.',
                'error_details' => $e->getMessage(),
            ], 500);
        }
    }


    public function upsertProduct(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'product_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'nullable|integer|exists:categories,category_id', // Ensure category exists
            'image' => 'nullable|url',
        ]);

        // Update or create product based on product_id
        $product = Product::updateOrCreate(
            ['id' => $validatedData['product_id']], // Match on product_id
            [
                'name' => $validatedData['name'],
                'price' => $validatedData['price'],
                'category_id' => $validatedData['category_id'] ?? null,
                'image' => $validatedData['image'] ?? null,
            ]
        );

        return response()->json([
            'success' => true,
            'message' => $product->wasRecentlyCreated ? 'Product created successfully' : 'Product updated successfully',
            'product' => $product,
        ]);



        // 'name'
        // , 'description'
        // , 'price'
        // , 'isAvailable'
        // , 'has_customization'
        // , 'image'
        // , 'category_number'

        // 'name' => 'Big Siomai',
        // 'description' => 'Delicious steamed dumplings filled with pork and spices.',
        // 'price' => 2.50,
        // 'isAvailable' => true,
        // 'has_customization' => false,
        // 'image' => 'assets/big_siomai.jpg',
        // 'category_number' => 7, // Snack
        // 'created_at' => now(),
    }
}
