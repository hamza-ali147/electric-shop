@extends('backend.layout.master') <!-- Ensure you have a layout file -->

@section('body')
<div class="container">
    <h1 class="mb-4">Order Items</h1>

    <!-- Display Total Order Items -->
    <p>Total Order Items: <strong>{{ $orderedItemCount }}</strong></p>

    <!-- Order Items Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Order ID</th>
                <th>Product ID</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orderItems as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->order_id }}</td>
                    <td>{{ $item->product_id }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ $item->price }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No Order Items Found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
