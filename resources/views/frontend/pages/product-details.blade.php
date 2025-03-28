@extends('frontend.layout.master')

@section('body')
<div class="container my-5">
    <div class="card product-details-card shadow-sm mx-auto" style="max-width: 500px;">
        <div class="card-body text-center">
            <img src="{{ asset("storage/{$product->thumbnail}") }}" alt="Thumbnail not found" class="img-fluid my-3" style="height: 300px; object-fit: cover;" loading="lazy">
            <h2 class="card-title">{{ $product->name }}</h2>
            <p class="card-text"><strong>Price:</strong>{{ $product->price }}</p>
            <p class="card-text"><strong>Category:</strong> {{ $product->category?->name }}</p>
            <p class="card-text"><strong>Brand:</strong> {{ $product->brand?->name }}</p>
            <p class="card-text"><strong>Description:</strong>{{ $product->description }}</p>
            <p class="card-text"><strong>color:</strong>{{ $product->color }}</p>
            
            <!-- Add to Cart Form -->
            <form action="{{ route('cart.store') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                
                <div class="mb-3">
                    <label for="quantity{{ $product->id }}" class="form-label"><strong>Quantity</strong></label>
                    <input type="number" class="form-control" id="quantity{{ $product->id }}" name="qty" value="1"  min="1">
                </div>
                
                <button type="submit" class="btn btn-primary">Add to Cart</button>
            </form>
        </div>
    </div>
</div>

<!-- Internal CSS for Hover Effects -->
<style>
    /* Card hover effect */
    .product-details-card {
        transition: transform 0.3s ease, background-color 0.3s ease;
    }

    .product-details-card:hover {
        background-color: #f8f9fa; /* Light background color change on hover */
        transform: translateY(-5px); /* Lift effect on hover */
    }

    .product-details-card:hover .btn-primary {
        background-color: #0056b3; /* Darker button color on hover */
        border-color: #0056b3;
    }

    .product-details-card:hover h2 {
        color: #017267; /* Change title color on hover */
    }
</style>
@endsection
