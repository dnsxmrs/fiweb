<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use App\Models\OrderProduct;


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
    public function category(Request $request)
    {
        // log incoming request
        Log::info('Received category request', [
            'request_method' => $request->method(),
            'request_data' => $request->all(),
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

                Log::info('Category updated successfully', [
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
                ], Response::HTTP_OK);
            } else {
                // Create a new category if it doesn't exist
                $category = Category::create([
                    'category_number' => $validatedData['category_number'],
                    'name' => $validatedData['category_name'],
                    'type' => $validatedData['type'],
                    'beverage_type' => $validatedData['beverage_type'] ?? null,
                    'image' => $validatedData['image_url'] ?: null,
                ]);

                Log::info('Category created successfully', [
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
                ], Response::HTTP_CREATED);
            }
        } catch (\Exception $e) {
            // Log the error with relevant context
            Log::error('Failed to process category operation', [
                'error' => $e->getMessage(),
                'data' => $validatedData,
            ]);

            // Return failure response
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to process category operation. An unexpected error occurred. Please try again later.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
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

            // if category is not found
            if (!$category) {
                Log::error('Category not found', [
                    'category_number' => $validatedData['category_number'],
                ]);
                return response()->json([
                    'status' => 'error',
                    'message' => 'Category not found.',
                    'errors' => [ $validatedData['category_number'] => 'Invalid or non-existent category number.']
                ], Response::HTTP_NOT_FOUND);
            }

            // delete the category if it exists
            $category->delete();

            Log::info('Category deleted successfully', [
                'category_number' => $validatedData['category_number'],
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Category deleted successfully!',
                'category_number' => $validatedData['category_number'],
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            // Log the error with relevant context
            Log::error('Failed to delete category', [
                'error' => $e->getMessage(),
                'category_number' => $validatedData['category_number'],
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'An unexpected error occurred. Please try again later.',
                // 'error_details' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // used in POS - creating and updating products
    public function product(Request $request)
    {
        // Log the incoming request data for debugging
        Log::info('Received product request', [
            'request_method' => $request->method(),
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
                Log::info('Product updated successfully', [
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
                    'status' => 'success',
                    'message' => 'Product updated successfully!',
                    'product' => $product
                ], 200);
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
                Log::info('Product created successfully', [
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
                    'status' => 'success',
                    'message' => 'Product created successfully!',
                    'product' => $product
                ], 201);
            }
        } catch (\Exception $e) {
            // Log the error with relevant context
            Log::error('Failed to process product operation', [
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

            Log::info('Product deleted successfully', [
                'product_id' => $validatedData['product_id'],
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Product deleted successfully!',
                'product_id' => $validatedData['product_id'],
            ], 200);
        } catch (\Exception $e) {
            Log::error('Failed to delete product', [
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

    public function getOrdersPaginate(Request $request)
    {
        $orders = Order::with('orderProducts')->paginate(15);

        Log::info('orders', [
            'orders' => $orders,
        ]);

        return response()->json([
            'data' => $orders
        ]);
    }

    public function getOrders(Request $request)
    {
        $orders = Order::select('id', 'order_number', 'order_type', 'total', 'status', 'first_name', 'last_name', 'contact_number', 'email', 'delivery_time')
            ->with(['orderProducts' => function($query) {
                $query->select('id', 'order_id', 'product_id', 'quantity', 'price')
                    ->with(['product' => function($query) {
                        $query->select('id', 'name');
                    }]);
            }])
            ->get();

        Log::info('orders', [
            'orders' => $orders,
        ]);

        return response()->json([
            'success' => true,
            'data' => $orders
        ], 200);
    }

    public function orderStatusUpdate(Request $request)
    {
        Log::info('Received status update request', [
            'request_method' => $request->method,
            'request_data' => $request->all(),
        ]);

        try
        {
            // Validate the incoming request
            $validatedData = $request->validate([
                'order_id' => 'required|integer|exists:orders,id',
                'order_number' => 'required|string',
                'status' => 'required|string|in:pending,preparing,ready,completed,cancelled',
            ]);

            Log::info('Validated status update request', [
                'validated_data' => $validatedData,
            ]);

            $order = Order::where('id', $validatedData['order_id'])->first();

            if (!$order) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Order not found.',
                ], 404);
            }

            $order->status = $validatedData['status'];
            $order->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Order status updated successfully!',
                'order' => $order,
            ], 200);
        }
        catch (\Exception $e)
        {
            Log::error('Failed to update order status', [
                'error' => $e->getMessage(),
                'data' => $validatedData,
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update order status.',
                'error_details' => $e->getMessage(),
            ], 500);
        }
    }

    public function getOrdersCount(Request $request)
    {
        Log::info('Received orders count request', [
            'request_method' => $request->method(),
            'request_data' => $request->all(),
        ]);
        // Get start and end dates from the request
        $start = $request->input('start'); // Assume 'start' is passed in the request
        $end = $request->input('end');     // Assume 'end' is passed in the request

        if (!$start || !$end) {
            return response()->json(['message' => 'Start and End dates are required'], 400);
        }

        try {
            // Query orders within the specified date range and group by order type
            $orderTypesCount = Order::whereBetween('created_at', [$start, $end])
                                    ->selectRaw('order_type, COUNT(*) as count')
                                    ->groupBy('order_type')
                                    ->get();

            Log::info('orders count by type', [
                'orders' => $orderTypesCount,
            ]);

            return response()->json([
                'online_orders_count' => $orderTypesCount,
            ]);
        } catch (\Exception $e) {
            Log::error("Error fetching orders count", ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Error fetching orders count'], 500);
        }
    }

    public function getDashboardDetails(Request $request)
    {
        Log::info('Received dashboard details request', [
            'request_method' => $request->method(),
            'request_data' => $request->all(),
        ]);

        // 1. Total Revenue (Sum of paid order totals)
        $totalRevenue = Order::where('status', 'completed')->sum('total');

        // 2. Total Dishes Ordered (Assuming you have an order_items table)
        $totalDishesOrdered = OrderProduct::sum('quantity'); // Sum all quantities across all orders

        // 3. Total Customers (Count distinct users who placed an order)
        $totalCustomers = Order::count();

        Log::info('Dashboard details', [
            'total_revenue' => $totalRevenue,
            'total_dishes_ordered' => $totalDishesOrdered,
            'total_customers' => $totalCustomers,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Order status updated successfully!',
            'totalRevenue' => $totalRevenue,
            'totalDishesOrdered' => $totalDishesOrdered,
            'totalCustomers' => $totalCustomers,
        ], 200);
    }
}
