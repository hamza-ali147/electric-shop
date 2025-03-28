@extends('backend.layout.master')
@section('body')
    <style>
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center
        }

        .card {
            /* border: 1px solid #000; */
            width: 18rem;
            margin-bottom: 20px;
        
        }

        .card img {
            width: 100%;
            height: 280px;
            object-fit: cover;
        }
    </style>
    {{-- @can('create products') --}}
        <a href="{{ route('products.create') }}" class="btn btn-primary mt-5 mb-5">Create New Product</a>
    {{-- @endcan --}}

    <div class="container mt-5 mb-5">
        <div class="card-container">
            @foreach ($products as $product)
                <div class="card">
                    <img src="{{ asset("storage{$product->thumbnail}") }}" alt="Thumbnail not found" loading="lazy">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text"><strong>Category:</strong> {{ $product->category?->name }}</p>
                        <p class="card-text"><strong>Brand:</strong> {{ $product->brand?->name }}</p>
                        <p class="card-text"><strong>Price:</strong> ${{ $product->price }}</p>
                        <p class="card-text"><strong>Color:</strong> {{ $product->color }}</p>
                        <p class="card-text"><strong>Description:</strong> {{ $product->description }}</p>
                        {{-- @can('edit products') --}}
                            <a href="{{ route('products.edit', ['product' => $product->id]) }}" class="btn btn-warning">Edit</a>
                        {{-- @endcan --}}
                        {{-- @can('delete products') --}}
                            <button class="btn btn-danger" type="button"
                                onclick="deleteProduct({{ $product->id }})">Delete</button>
                        {{-- @endcan --}}
                    </div>
                </div>
            @endforeach
        </div>

        {{-- <div class="mt-4">
            {{ $products->links() }}
        </div> --}}

        <form action="#" method="POST" id="deleteProductForm">
            @csrf
            @method('DELETE')
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        function deleteProduct(id) {
            const decision = confirm("Are you sure you want to delete the record?\nEither OK or Cancel.");
            if (decision) {
                const form = document.getElementById('deleteProductForm');
                form.action = `/product/${id}/destroy`;
                form.submit();
            }
        }
    </script>
@endpush
