@extends('frontend.layout.master')

@section('body')
    <div class="container">
        <h1 class="mt-5">Cart Items</h1>

        @if ($cartItems->isEmpty())
            <p>Your cart is empty.</p>
        @else
            <div class="row mt-4">
                @foreach ($cartItems as $item)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->product->name }}</h5>
                                <p class="card-text">Price: ${{ number_format($item->product->price, 2) }}</p>
                                <p class="card-text">Quantity: 
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <div class="input-group">
                                            <button type="submit" name="action" value="decrease" class="btn btn-outline-secondary btn-sm">-</button>
                                            <input type="number" name="qty" value="{{ $item->qty }}" class="form-control text-center" readonly style="width: 60px;">
                                            <button type="submit" name="action" value="increase" class="btn btn-outline-secondary btn-sm">+</button>
                                        </div>
                                    </form>
                                </p>
                                <p class="card-text">Total: ${{ number_format($item->qty * $item->product->price, 2) }}</p>
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Checkout Button -->
            <div class="d-flex justify-content-start" style="margin-bottom: 100px">
                <a href="{{ route('checkout.index') }}" class="btn btn-primary">Proceed to Checkout</a>
            </div>
        @endif
    </div>
@endsection
