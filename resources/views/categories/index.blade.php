@extends('backend.layout.master')

@section('body')
    <style>
        .card {
            margin-bottom: 20px;
            justify-content: center
        }
    </style>

    <div class="container mt-5">
        {{-- @can('create categories') --}}
        <a href="{{ route('categories.create') }}" class="btn btn-primary mb-4">Create</a>
        {{-- @endcan --}}
        

        <div class="row">
            @foreach ($products as $data)
                <div class="col-md-4 mb-5"> <!-- Adjust column size as needed -->
                    <div class="card" style="height: 100%">
                        <img src="{{ asset("storage{$data->thumbnail}") }}" alt="Thumbnail not found" class="card-img-top"
                            style="height: 250px; object-fit: contain; width:100%;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $data->name }}</h5>
                            <p class="card-text">Number of Products: {{ $data->products_count }}</p>
                            <div class="d-flex justify-content-start" style="gap: 20px">
                                {{-- @can('edit categories') --}}
                                <a href="{{ route('categories.edit', ['category' => $data->id]) }}"
                                    class="btn btn-warning">Edit</a>
                                {{-- @endcan --}}
                            {{-- @can('delete categories') --}}
                            <button class="btn btn-danger" type="button"
                            onclick="deleteCategory({{ $data->id }})">Delete</button>
                            {{-- @endcan --}}
                            
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    
        
        <form action="#" method="POST" id="deleteCategoryForm">
            @csrf
            @method('DELETE')
        </form>

    </div>
@endsection

@push('scripts')
    <script>
        function deleteCategory(id) {
            const decision = confirm("Are you sure you want to delete the record?\nEither OK or Cancel.");
            if (decision) {
                const form = document.getElementById('deleteCategoryForm');
                form.action = `/category/${id}/destroy`;
                form.submit();
            }
        }
    </script>
@endpush
