@extends('backend.layout.master')

@section('body')
<div class="container">
    <div class="d-flex justify-content-between align-items-center my-3">
        <h2 class="font-weight-semibold text-dark">
            Products / Create
        </h2>
        <a href="{{ route('products.index') }}" class="btn btn-primary text-white">Back</a>
    </div>

    <div class="card mt-4 p-4 shadow-sm">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12 mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select name="category_id" id="category_id" class="form-select">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 mb-3">
                    <label for="brand_id" class="form-label">Brand</label>
                    <select name="brand_id" id="brand_id" class="form-select">
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter product name" required>
                </div>

                <div class="col-12 mb-3">
                    <label for="color" class="form-label">Color</label>
                    <select name="color" class="form-select" required>
                        <option value="White">White</option>
                        <option value="Black">Black</option>
                        <option value="Brown">Brown</option>
                        <option value="Cream">Cream</option>
                    </select>
                </div>

                <div class="col-12 mb-3">
                    <label for="productDescription" class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="productDescription" rows="3" placeholder="Enter product description" required></textarea>
                </div>

                <div class="col-12 mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" name="price" class="form-control" placeholder="Enter price" required>
                </div>

                <div class="col-12 mb-3">
                    <label for="thumbnail" class="form-label">Thumbnail</label>
                    <input type="file" name="thumbnail" class="form-control" required accept="image/png, image/gif, image/jpeg">
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary w-100">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
