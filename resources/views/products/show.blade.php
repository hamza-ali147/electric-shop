@extends('frontend.layout.master')

@section('body')
<div class="container">
    <div class="product-details">
        <h1>{{ $product->name }}</h1>
        <img src="{{ asset('assets1/images/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid">
        <p>{{ $product->description }}</p>
        <p>Price: ${{ $product->price }}</p>
        
        <!-- Add to Cart Button -->
        <form action="{{ route('cart.add', $product->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Add to Cart</button>
        </form>
    </div>
</div>
@endsection
