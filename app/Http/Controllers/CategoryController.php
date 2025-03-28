<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\View\View as ViewView;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\View\View as IlluminateViewView;

class CategoryController extends Controller //implements HasMiddleware
{
    // public static function middleware(): array
    // {
    //     return [

    //         new Middleware('permission:view categories', only: ['index']),
    //         new Middleware('permission:create categories', only: ['create']),
    //         new Middleware('permission:edit categories', only: ['edit']),
    //         new Middleware('permission:delete categories', only: ['destroy']),
    //     ];
    // }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // Handle thumbnail upload
    $file = $request->file('thumbnail');
    $time = time();
    $ext = $file->getClientOriginalExtension();
    $filename = "{$time}.{$ext}";
    $path = '/categories/thumbnail';
    Storage::disk('public')->putFileAs($path, $file, $filename);

        $product = new Category();
        $product->name = $request->name;
        $product->thumbnail = "{$path}/{$filename}"; 
        $product->save();

        return back()->with('success', 'Category created successfully');
    }

    public function index()
    {
        // $products = Category::with(['products'])->get(['id', 'name']);
        $products = Category::withCount('products')->get(['id', 'name']);
        $data = compact('products');
        return view('categories.index', $data);
    }
    
    public function edit($id)
    {
        $product = Category::findOrFail($id);
        return view('categories.edit', compact('product'));
    }

    // public function update(Request $request, $id)
    // {
    //     $product = Category::findOrFail($id);
    //     $product->name = $request->name;
    //     $product->update();

    //     return to_route('categories.index');
    // }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  // Image is optional
        ]);
    
        // Find the existing category
        $product = Category::findOrFail($id);
        $product->name = $request->name;
    
        // Check if a new thumbnail image is provided
        if ($request->hasFile('thumbnail')) {
            // Handle the image upload
            $file = $request->file('thumbnail');
            $time = time();
            $ext = $file->getClientOriginalExtension();
            $filename = "{$time}.{$ext}";
            $path = '/categories/thumbnail';
            
            // Store the new file and update the thumbnail path in the database
            Storage::disk('public')->putFileAs($path, $file, $filename);
            $product->thumbnail = "{$path}/{$filename}";
        }
    
        // Save the updated category
        $product->save();
    
        // Redirect to the brand index page with a success message
        return redirect()->route('categories.index')->with('success', 'category updated successfully');
    }
    

    public function destroy(Category $category)
{
    $category->delete();
    return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
}
public function showProductForm()
{
    $categories = Category::all(); // Assuming you have a Category model
    return view('product.form', compact('categories'));
}

public function show($id)
{
    $category = Category::withCount('products')->findOrFail($id);
    return view('categories.show', compact('category'));
}
}
