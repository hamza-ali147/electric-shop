@extends('backend.layout.master')

@section('body')
    <div class="card mt-5" style="margin-bottom:10%">
        <form action="{{ route('categories.update', ['category' => $product->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row mt-5">
                <div class="col-12 mb-3">
                    <input type="text" name="name" class="form-control" value="{{ $product->name }}" placeholder="Name"
                        required>
                </div>

                <div class="col-12 mb-3">
                    <label for="current-thumbnail">Current Thumbnail:</label>
                    <div>
                        <img src="{{ asset("storage{$product->thumbnail}") }}" alt="Current thumbnail" style="width: 100px;"
                            required>
                    </div>
                </div>

                <div class="col-12 mb-3">
                    <label for="thumbnail">Update Thumbnail (optional):</label>
                    <input type="file" name="thumbnail" class="form-control" accept="image/png, image/gif, image/jpeg">
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary d-block ms-auto">Save</button>
                </div>
            </div>
        </form>
      
    </div>
@endsection
