@extends('backend.layout.master')

@section('body')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center my-3">
            <h2 class="font-weight-semibold text-dark">
                Brands / Create
            </h2>
            <a href="{{ route('brands.index') }}" class="btn btn-primary text-white">Back</a>
        </div>
        <div class="row mt-5" style="margin-bottom: 10%">
            <!-- Make sure the form uses multipart/form-data to handle file uploads -->
            <form action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-12 mb-3">
                    <input type="text" name="name" class="form-control" placeholder="Name" required>
                </div>
                <div class="col-12 mb-3">
                    <input type="file" name="thumbnail" class="form-control" required accept="image/png, image/gif, image/jpeg">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary d-block ms-auto">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
