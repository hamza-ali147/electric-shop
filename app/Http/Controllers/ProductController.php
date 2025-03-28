<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ProductController extends Controller //implements HasMiddleware
{
    // public static function middleware(): array
    // {
    //     return [

    //         new Middleware('permission:view products', only: ['index']),
    //         new Middleware('permission:create products', only: ['create']),
    //         new Middleware('permission:edit products', only: ['edit']),
    //         new Middleware('permission:delete products', only: ['destroy']),
    //     ];
    // }
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();

        return view('products.create', compact('categories', 'brands'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:25',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string|',
            'color' => 'required|string|',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $file = $request->file('thumbnail');
        $time = time();
        $ext = $file->getClientOriginalExtension();
        $filename = "{$time}.{$ext}";
        $path = '/products/thumbnail';
        Storage::disk('public')->putFileAs($path, $file, $filename);
        $product = new Product();
        $product->name = $request->name;
        $product->color = $request->color;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->thumbnail = "{$path}/{$filename}";
        $product->save();

        return back()->with('success', 'Product created successfully');
    }


    // public function edit($id)
    // {
    //     $product = Product::findOrFail($id);
    //     return view('product.edit', compact('product'));
    // }
    public function edit($id)
    {
        // Fetch the product to be edited
        $product = Product::findOrFail($id);

        // Fetch categories and brands
        $categories = Category::all();
        $brands = Brand::all();

        // Return the edit view with the product, categories, and brands
        return view('products.edit', compact('product', 'categories', 'brands'));
    }

    // public function update(Request $request, $id)
    // {
    //     $product = Product::findOrFail($id);
    //     $product->name = $request->name;
    //     $product->price = $request->price;
    //     $product->description = $request->description;
    //     $product->color = $request->color;
    //     $product->thumbnail = $request->thumbnail;
    //     $product->update();

    //     return to_route('product.index');
    // }
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'color' => 'nullable|string|max:50',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Image is optional, only if uploaded
        ]);

        // Find the product
        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->color = $request->color;

        // Check if a new image (thumbnail) is uploaded
        if ($request->hasFile('thumbnail')) {
            // Handle the image upload
            $file = $request->file('thumbnail');
            $time = time();
            $ext = $file->getClientOriginalExtension();
            $filename = "{$time}.{$ext}";
            $path = '/products/thumbnails';

            // Store the new file and update the thumbnail path in the database
            Storage::disk('public')->putFileAs($path, $file, $filename);

            // Update the product's thumbnail field
            $product->thumbnail = "{$path}/{$filename}";
        }

        // Update the product with new data
        $product->save();

        // Redirect back to the product index page with a success message
        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }


    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
    public function index(Request $request)
    {
        $categories = Category::all();
        $brands = Brand::all();

        $products = Product::with(['category', 'brand'])->paginate(6);

        // Provide cart data to the view
        $cart = session('cart', []);
        return view('products.index', compact('categories', 'brands', 'products', 'cart'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id); // Fetch the product by ID
        return view('frontend.pages.product-details', compact('product'));
    }
}
