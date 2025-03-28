<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderItemController extends Controller
{
    public function index()
    {
        $orderItems = OrderItem::all(); // Fetch all order items
        $orderedItemCount = $orderItems->count(); // Count the total number of order items
    
        return view('order_items.index', compact('orderItems', 'orderedItemCount'));
    }
}
