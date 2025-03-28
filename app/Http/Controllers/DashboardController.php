<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controller as BaseController;


// class DashboardController extends Controller
class DashboardController extends BaseController

{
    public function __construct()
    {
        $this->middleware(['auth', 'verified', 'admin',]);
    }

    // public function index()
    // {
    //     // Define counts for products, categories, and brands
    //     $productCount = Product::count();
    //     $categoryCount = Category::count();
    //     $brandCount = Brand::count();
    //     $orderCount = Order::count();
    //     // Example chart data for products by category and brands overview
    //     $productData = Product::selectRaw('categories.name as category, count(*) as count')
    //         ->join('categories', 'products.category_id', '=', 'categories.id')
    //         ->groupBy('categories.name')
    //         ->pluck('count', 'category')
    //         ->toArray();

    //     $brandData = Brand::selectRaw('brands.name, count(*) as count')
    //         ->join('products', 'products.brand_id', '=', 'brands.id')
    //         ->groupBy('brands.name')
    //         ->pluck('count', 'brands.name')
    //         ->toArray();

    //     // Pass the counts to the view
    //     return view('dashboard', compact('productCount', 'categoryCount', 'brandCount', 'orderCount', 'productData', 'brandData'));
    // }

    public function index()
{
    // Define counts for products, categories, brands, users, and orders
    $productCount = Product::count();
    $categoryCount = Category::count();
    $brandCount = Brand::count();
    $orderCount = Order::count();
    $userCount = User::count();
    $orderedItemCount = OrderItem::count(); // Use the correct variable name

    // Example chart data for products by category and brands overview
    $productData = Product::selectRaw('categories.name as category, count(*) as count')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->groupBy('categories.name')
        ->pluck('count', 'category')
        ->toArray();

    $brandData = Brand::selectRaw('brands.name, count(*) as count')
        ->join('products', 'products.brand_id', '=', 'brands.id')
        ->groupBy('brands.name')
        ->pluck('count', 'brands.name')
        ->toArray();

    // Pass the counts and data to the view
    return view('dashboard', compact(
        'productCount',
        'categoryCount',
        'brandCount',
        'orderCount',
        'userCount',
        'orderedItemCount', // Update to use the correct variable name
        'productData',
        'brandData'
    ));
}


}
