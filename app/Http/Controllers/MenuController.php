<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    // show menu from categories with products
    public function getMenu()
    {
        // Fetch categories with their products
        $categories = Category::with('products')->get();
        return view('components.menu', compact('categories'));
    }


    // get menu using menu table (non existing)
    public function showMenu()
    {
        // $menuItems = MenuItem::all();
        return view('components.menu', compact('menuItems'));
    }

    // function to update menu item
    // public function updateMenu(MenuItem $item, Request $request)
    // {
    //     $item->update($request->all());
    //     broadcast(new MenuUpdated($item));
    // }
}
