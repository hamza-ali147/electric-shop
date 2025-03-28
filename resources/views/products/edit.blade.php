@extends('backend.layout.master')

@section('body')

    <div class="card mt-5">
        <form action="{{ route('products.update', ['product' => $product->id]) }}" method="POST" enctype="multipart/form-data" style="margin-bottom: 10%;">
            @csrf
            @method('PUT')
            <div class="row">
                <!-- Category Selection -->
                <div class="col-12 mb-3">
                    <select name="category_id" id="category_id" class="form-select">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Brand Selection -->
                <div class="col-12 mb-3">
                    <select name="brand_id" id="brand_id" class="form-select">
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                                {{ $brand->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Product Name -->
                <div class="col-12 mb-3">
                    <input type="text" name="name" class="form-control" value="{{ $product->name }}" placeholder="Name" required>
                </div>

                <!-- Color Selection -->
                <div class="col-12 mb-3">
                    <select name="color" class="form-select" required>
                        <option value="White" {{ $product->color == 'White' ? 'selected' : '' }}>White</option>
                        <option value="Black" {{ $product->color == 'Black' ? 'selected' : '' }}>Black</option>
                        <option value="Brown" {{ $product->color == 'Brown' ? 'selected' : '' }}>Brown</option>
                        <option value="Cream" {{ $product->color == 'Cream' ? 'selected' : '' }}>Cream</option>
                    </select>
                </div>

                <!-- Description -->
                <div class="col-12 mb-3">
                    <textarea class="form-control" name="description" id="productDescription" rows="3" placeholder="Description" required>{{ $product->description }}</textarea>
                </div>

                <!-- Price -->
                <div class="col-12 mb-3">
                    <input type="number" name="price" class="form-control" value="{{ $product->price }}" placeholder="Price" required>
                </div>

                <!-- Thumbnail Upload -->
                <div class="col-12 mb-3">
                    <label for="thumbnail">Update Thumbnail (optional):</label>
                    <input type="file" name="thumbnail" class="form-control" accept="image/png, image/gif, image/jpeg">

                    <!-- Display Current Thumbnail -->
                    @if($product->thumbnail)
                        <div class="mt-3">
                            <label>Current Thumbnail:</label><br>
                            <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="Current Thumbnail" style="width: 100px; height: 100px; object-fit: cover;">
                        </div>
                    @endif
                </div>

                <!-- Save Button -->
                <div class="col-12">
                    <button type="submit" class="btn btn-primary d-block ms-auto">Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection

