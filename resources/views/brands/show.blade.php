@extends('frontend.layout.master')

@section('body')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Brand Detail Card with Animation -->
                <div class="card shadow-sm animated fadeInUp w-50">
                    <img src="{{ asset("storage{$brand->thumbnail}") }}" alt="Thumbnail not found" class="card-img-top" />
                    <div class="card-body">
                        <h2 class="card-title"><strong>Name:</strong>{{ $brand->name }}</h2>
                        <p class="card-text"><strong>Detail for Brand:</strong> {{ $brand->name }}</p>
                        <!-- Add more brand details as needed -->
                        <a href="{{ route('home') }}" class="btn btn-primary">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('styles')
    <style>
        /* Card Animation on Hover */
        .card {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }
    
        .card:hover {
            transform: scale(1.05); /* Slightly enlarge the card */
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); /* Add a shadow effect */
        }
    
        /* Button Animation on Hover */
        .card:hover .btn-primary {
            background-color: #017267; /* Change to a different color */
            border-color: #017267;
        }

        /* Animation Effects */
        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animated {
            animation-duration: 1s;
            animation-fill-mode: both;
        }

        .fadeInUp {
            animation-name: fadeInUp;
        }
    </style>
@endsection
