<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class RoleController extends Controller //implements HasMiddleware
{
    // public static function middleware(): array
    // {
    //     return [
            
    //         new Middleware('permission:view roles', only: ['index']),
    //         new Middleware('permission:create roles', only: ['create']),
    //         new Middleware('permission:edit roles', only: ['edit']),
    //         new Middleware('permission:delete roles', only: ['destroy']),
    //     ];
    // }
    // this method will show role page
    public function index()
    {
        $roles = Role::orderBy('name', 'ASC')->paginate(10);
        return view( 'roles.list' ,[
            'roles' => $roles
        ] );
    }
    // this method will show create role page
    public function create()
    {
        $permissions = Permission::orderBy('name', 'ASC')->get();
        return view('roles.create', [
            'permissions' => $permissions
        ]);
    }
    // this method will insert a role in DB
        public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|unique:roles|min:3'
    ]);

    if ($validator->passes()) {
        $roles = Role::create(['name' => $request->name]);
        
        // Correct method givePermissionTo
        if (!empty($request->permission)) {
            foreach ($request->permission as $name) {
                $roles->givePermissionTo($name); // Corrected here
            }
        }

        return redirect()->route('roles.index')->with('success', 'Role added successfully.');
    } else {
        return redirect()->route('roles.create')->withInput()->withErrors($validator);
    }
}

    public function edit($id)
{
    $role = Role::findOrFail($id);
    $hasPermissions = $role->permissions->pluck('name')->toArray();
    $permissions = Permission::orderBy('name', 'ASC')->get();

    return view('roles.edit', [
        'role' => $role, // Ensure 'role' is passed to the view
        'permissions' => $permissions, // Update the key to 'permissions'
        'hasPermissions' => $hasPermissions
    ]);
}


    // this method will update a permission page
    public function update($id, Request $request)
    {
        $role = Role::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name,'.$id. ',id'
        ]);
    
        if ($validator->passes()) {
            // $roles = Role::create(['name' => $request->name]);
            $role->name = $request->name;
            $role -> save();
            // Correct method givePermissionTo
            if (!empty($request->permission)) {
            $role->syncPermissions($request->permission);
            }else{
                $role->syncPermissions([]);
            }
    
            return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
        } else {
            return redirect()->route('roles.edit',$id)->withInput()->withErrors($validator);
        }
    }

    public function destroy(Request $request, $id)
{
    $role = Role::find($id);

    if ($role == null) {
        session()->flash('error', 'Role not found');
        return response()->json([
            'status' => false
        ]);
    }

    $role->delete();

    session()->flash('success', 'Role deleted successfully');
    return response()->json([
        'status' => true
    ]);
}

}
