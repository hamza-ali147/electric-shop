<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use spaite\Permission\Models\Roles;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [

            new Middleware('permission:view users', only: ['index']),
            new Middleware('permission:create users', only: ['create']),
            new Middleware('permission:edit users', only: ['edit']),
            new Middleware('permission:delete users', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('users.list', [
            'users' => $users
        ]);
    }
    public function create()
    {
        $roles = Role::orderBy('name', 'ASC')->get();
        return view('users.create', [
            'roles' => $roles,
        ]);
    }

    public function store(Request $request)
    {
        // $user = User::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4|same:confirm_password',
            'confirm_password' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->route('users.create')->withInput()->withErrors($validator);
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $user->syncRoles($request->role);
        return redirect()->route('users.index')->with('success', 'users  successfully');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::orderBy('name', 'ASC')->get();
        $hasRoles = $user->roles->pluck('id');
        return view('users.edit', [
            'user' => $user,
            'roles' => $roles,
            'hasRoles' => $hasRoles
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $id . ',id'
        ]);
        if ($validator->fails()) {
            return redirect()->route('users.edit')->withInput()->withErrors($validator);
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        $user->syncRoles($request->role);
        return redirect()->route('users.index')->with('success', 'users updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Request $request)
    // {
    //     $user = User::find($request->id);
    //     if ($user == null) {
    //         session()->flash('error', 'users not found');
    //         return response()->json([
    //             'status' => false
    //         ]);
    //     }
    //     $user->delete();
    //     session()->flash('success', 'users deleted successfully');
    //     return response()->json([
    //         'status' => true
    //     ]);
    // }
    public function destroy(Request $request, $id)
{
    $user = User::find($id); // Use $id from the route parameter

    if (!$user) {
        return response()->json([
            'status' => false,
            'message' => 'User not found'
        ]);
    }

    try {
        $user->delete();
        return response()->json([
            'status' => true,
            'message' => 'User deleted successfully'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'Failed to delete user: ' . $e->getMessage()
        ]);
    }
}

}
