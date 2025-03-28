<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
class PermissionController extends Controller implements HasMiddleware
{
    public static function middleware(): array
{
    return [
        
        new Middleware('permission:view permissions', only: ['index']),
        new Middleware('permission:create permissions', only: ['create']),
        new Middleware('permission:edit permissions', only: ['edit']),
        new Middleware('permission:delete permissions', only: ['destroy']),
    ];
}
    // this method will show permission page
    public function index()
    {
        $permissions = Permission::orderBy('created_at', 'DESC')->paginate(10);
        return view('permissions.list', compact('permissions'), [
            'permission' => $permissions
        ]);
    }
    // this method will show create permission page
    public function create()
    {
        return view('permissions.create');
    }
    // this method will insert a permission in DB
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions|min:3'
        ]);
        if ($validator->passes()) {
            Permission::create(['name' => $request->name]);
            return redirect()->route('permissions.index')->with('success', 'Permission added successfully.');
        } else {
            return redirect()->route('permissions.create')->withInput()->withErrors($validator);
        }
    }
    // this method will show edit permission page
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('permissions.edit', [
            'permission' => $permission
        ]);
    }
    // this method will update a permission page
    public function update($id, Request $request)
    {
        $permission = Permission::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|unique:permissions,name,' . $id . ',id'
        ]);
        if ($validator->passes()) {
            $permission->name = $request->name;
            $permission->save();
            return redirect()->route('permissions.index')->with('success', 'Permission updated successfully.');
        } else {
            return redirect()->route('permissions.edit', $id)->withInput()->withErrors($validator);
        }
    }
    // this method will delete a permission in DB
    // public function destroy(Request $request)
    // {
    //     $id = $request->id;
    //     $permission = Permission::find($id);
    //     if ($permission == null) {
    //         session()->flash('error', 'permission not found');
    //         return response()->json([
    //             'status' => false
    //         ]);
    //     }
    //     $permission->delete();
    //     session()->flash('success', 'permission deleted successfully');
    //     return response()->json([
    //         'status' => true
    //     ]);
    // }
    public function destroy(Request $request, $id)
{
    $permission = Permission::find($id);

    if ($permission == null) {
        session()->flash('error', 'Permission not found');
        return response()->json([
            'status' => false
        ]);
    }

    $permission->delete();

    session()->flash('success', 'Permission deleted successfully');
    return response()->json([
        'status' => true
    ]);
}

}
