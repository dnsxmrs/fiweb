<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class APIController extends Controller
{
    // Get all products used for testing in postman
    public function getProduct()
    {
        $products = Product::with('category')->get();

        // Transform the product data to include the category name
        $products = $products->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
                'isAvailable' => $product->isAvailable,
                'image' => $product->image,
                'created_at' => $product->created_at,
                'updated_at' => $product->updated_at,
                'deleted_at' => $product->deleted_at,

                'category_id' => $product->category_id,
                'category_name' => $product->category ? $product->category->name : null,
                'category_image' => $product->category ? $product->category->image : null,
                'category_created_at' => $product->category->created_at,
                'category_updated_at' => $product->category->updated_at,
            ];
        });

        return response()->json($products);
    }

    // Get one product used in the product details page
    public function getOneProduct($id)
    {
        $product = Product::with('category')  // Eager load category relationship
                    ->findOrFail($id);


        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        // Transform the product data to include the category name
        $product = [
            'id' => $product->id,
            'name' => $product->name,
            // 'description' => $product->description,
            'price' => $product->price,
            'isAvailable' => $product->isAvailable,
            'image' => $product->image,
            // 'created_at' => $product->created_at,
            // 'updated_at' => $product->updated_at,
            // 'deleted_at' => $product->deleted_at,

            'category_id' => $product->category_id,
            'category_name' => $product->category ? $product->category->name : null,
            // 'category_image' => $product->category ? $product->category->image : null,
            // 'category_created_at' => $product->category->created_at,
            // 'category_updated_at' => $product->category->updated_at,
        ];

        return response()->json($product);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,png,jpeg|max:2048', // Validation
        ]);

        $uploadedFileUrl = Cloudinary::upload($request->file('file')->getRealPath())->getSecurePath();

        return response()->json(['url' => $uploadedFileUrl]);
    }
}
