<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductFilterController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'brand']);

        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        if ($request->has('brand') && $request->brand != '') {
            $query->where('brand_id', $request->brand);
        }

        $products = $query->paginate(6); // Adjust pagination per page here
        $categories = Category::all();
        $brands = Brand::all();

        return view('filters.index', compact('products', 'categories', 'brands'));
    }

    public function filterByCategory($id)
    {
        $products = Product::with(['category', 'brand'])->where('category_id', $id)->paginate(6);
        $categories = Category::all();
        $brands = Brand::all();

        return view('filters.index', compact('products', 'categories', 'brands'));
    }

    public function filterByBrand($id)
    {
        $products = Product::with(['category', 'brand'])->where('brand_id', $id)->paginate(6);
        $categories = Category::all();
        $brands = Brand::all();

        return view('filters.index', compact('products', 'categories', 'brands'));
    }
}
