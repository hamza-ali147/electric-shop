<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
class OrderController extends Controller //implements HasMiddleware 
{
    // public static function middleware(): array
    // {
    //     return [

    //         new Middleware('permission:view orders', only: ['index']),
    //         new Middleware('permission:create orders', only: ['create']),
    //         new Middleware('permission:edit orders', only: ['edit']),
    //         new Middleware('permission:delete orders', only: ['destroy']),
    //     ];
    // }
    public function index()
    {
        $orders = Order::all(); // Adjust this to your specific query or pagination
        return view('backend.orders.index', compact('orders'));
    }
    public function show($id)
{
    $order = Order::findOrFail($id); // Find the order by ID
    return view('backend.orders.show', compact('order'));
}
public function edit($id)
{
    $order = Order::findOrFail($id); // Find the order by ID
    return view('backend.orders.edit', compact('order'));
}
public function destroy($id)
{
    $order = Order::findOrFail($id); // Find the order by ID
    $order->delete(); // Delete the order
    return redirect()->route('orders.index')->with('success', 'Order deleted successfully');
}
public function updateStatus(Request $request, $id)
{
    $order = Order::findOrFail($id);
    $order->status = $request->status; // 'pending' or 'delivered'
    $order->save();

    return redirect()->back()->with('success', 'Order status updated successfully.');
}
}
