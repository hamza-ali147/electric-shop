@extends('backend.layout.master')

@section('body')
<div class="container mt-5">
    <h2>Order Details</h2>

    <div class="card">
        <div class="card-body">
            <h5>Order ID: {{ $order->id }}</h5>
            <p>Customer Name: {{ $order->name }}</p>
            <p>Total Amount: {{ $order->total }}</p>
            <p>Status: {{ $order->status }}</p>
            <p>Order Date: {{ $order->created_at->format('Y-m-d') }}</p>
            <!-- Add more order details here as needed -->
        </div>
    </div>

    <a href="{{ route('orders.index') }}" class="btn btn-secondary mt-3">Back to Orders</a>
</div>
@endsection
