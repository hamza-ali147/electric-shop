<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class BrandController extends Controller //implements HasMiddleware
{
    // public static function middleware(): array
    // {
    //     return [

    //         new Middleware('permission:view brands', only: ['index']),
    //         new Middleware('permission:create brands', only: ['create']),
    //         new Middleware('permission:edit brands', only: ['edit']),
    //         new Middleware('permission:delete brands', only: ['destroy']),
    //     ];
    // }
    public function create()
    {
        return view('brands.create');
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //     ]);
    //     $brand = new Brand();
    //     $brand->name = $request->name;
    //     $brand->save();
    //     return back();
    // }
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
    $path = '/brands/thumbnail';
    Storage::disk('public')->putFileAs($path, $file, $filename);

    // Create new brand
    $brand = new Brand();
    $brand->name = $request->name;
    $brand->thumbnail = "{$path}/{$filename}";  // Store the path of the uploaded image
    $brand->save();

    return back()->with('success', 'Brand created successfully');
}

    public function index()
    {
        $brands = Brand::withCount('products')->get(['id', 'name','thumbnail']);
        $data = compact('brands');
        return view('brands.index', $data);
    }
    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('brands.edit', compact('brand'));
    }
// public function update(Request $request, $id)
//     {
//         $brand = Brand::findOrFail($id);
//         $brand -> name = $request->name;
//         $brand->update();

//         return to_route('brands.index');
//     }
    // public function update(Request $request, $id)
    // {
    //     $brand = Brand::findOrFail($id);
    //     $brand->name = $request->name;
    //     $brand->save();

    //     return redirect()->route('brands.index');
    // }
    public function update(Request $request, $id)
{
    // Validate the incoming request data
    $request->validate([
        'name' => 'required|string|max:255',
        'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  // Image is optional
    ]);

    // Find the existing brand
    $brand = Brand::findOrFail($id);
    $brand->name = $request->name;

    // Check if a new thumbnail image is provided
    if ($request->hasFile('thumbnail')) {
        // Handle the image upload
        $file = $request->file('thumbnail');
        $time = time();
        $ext = $file->getClientOriginalExtension();
        $filename = "{$time}.{$ext}";
        $path = '/brands/thumbnail';
        
        // Store the new file and update the thumbnail path in the database
        Storage::disk('public')->putFileAs($path, $file, $filename);
        $brand->thumbnail = "{$path}/{$filename}";
    }

    // Save the updated brand
    $brand->save();

    // Redirect to the brand index page with a success message
    return redirect()->route('brands.index')->with('success', 'Brand updated successfully');
}


    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('brands.index')->with('success', 'Brand deleted successfully');
    }

    public function show($id)
    {
        $brand = Brand::findOrFail($id);
        return view('brands.show', compact('brand'));
    }
    
}
