@extends('backend.layout.master')

@section('body')
<div class="container mt-5">
    <h2>Edit Order</h2>

    <form action="{{ route('orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Order fields to edit -->
        <div class="form-group mb-3">
            <label for="customer_name">Customer Name</label>
            <input type="text" name="customer_name" id="customer_name" class="form-control" value="{{ $order->customer_name }}">
        </div>

        <div class="form-group mb-3">
            <label for="total_amount">Total Amount</label>
            <input type="text" name="total_amount" id="total_amount" class="form-control" value="{{ $order->total_amount }}">
        </div>

        <div class="form-group mb-3">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Order</button>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back to Orders</a>
    </form>
</div>
@endsection
