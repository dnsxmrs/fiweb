<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class WebController extends Controller
{
    //
    public function getCategory()
    {
        $categories = Category::all();
        return view('welcome', compact('categories'));
    }

    public function orderNow()
    {
        $categories = Category::all();
        $products = Product::where('isAvailable', 1)->get();

        return view('menu.order-now', compact('categories', 'products'));
    }

    public function checkout()
    {
        return view('order-checkout.order-checkout');
    }
}
