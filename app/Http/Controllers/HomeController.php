<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $brands = Brand::all(); // Retrieve all brands
        $categories = Category::all(); // Retrieve all categories

        // Return the view with the products, brands, and categories data
        return view('frontend.pages.index', compact('products', 'brands', 'categories'));
    }

}
