@extends('backend.layout.master')

@section('body')
    <style>
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 20px;
            margin-bottom: 20px;
            justify-content: center

        }

        .card {
            width: 18rem;
            /* border: 2px solid black; */
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: contain;
        }
    </style>

    {{-- @can('create brands') --}}
        <a href="{{ route('brands.create') }}" class="btn btn-primary mt-5 mb-5">Create</a>
    {{-- @endcan --}}

    <div class="card-container">
        @foreach ($brands as $data)
            <div class="card" >
                <img src="{{ asset("storage{$data->thumbnail}") }}" alt="Thumbnail not found" class="card-img-top" loading="lazy">
                <div class="card-body">
                    <h5 class="card-title">{{ $data->name }}</h5>
                    <p class="card-text">Products: {{ $data->products_count }}</p>

                    <div class="d-flex justify-content-between">
                        {{-- @can('edit brands') --}}
                            <a href="{{ route('brands.edit', ['brand' => $data->id]) }}" class="btn btn-warning">Edit</a>
                        {{-- @endcan --}}

                        {{-- @can('delete brands') --}}
                            <button class="btn btn-danger" type="button" onclick="deleteBrand({{ $data->id }})">Delete</button>
                        {{-- @endcan --}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Delete Brand Form -->
    <form action="#" method="POST" id="deleteBrandForm">
        @csrf
        @method('DELETE')
    </form>
@endsection

@push('scripts')
    <script>
        function deleteBrand(id) {
            const decision = confirm("Are you sure you want to delete the record?\nEither OK or Cancel.");
            if (decision) {
                const form = document.getElementById('deleteBrandForm');
                form.action = `/brand/${id}/destroy`;
                form.submit();
            }
        }
    </script>
@endpush
