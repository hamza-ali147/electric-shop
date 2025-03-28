<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.partials.head')
    <style>
        /* Card Animation on Hover */
        .card {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .card:hover .btn-primary {
            background-color: #017267;
            border-color: #017267;
        }
    </style>
</head>

<body>
    <!-- Navbar Start -->
    @include('frontend.partials.navbar')

    <!-- Main Section -->
    <section class="text-white text-center py-5"
        style="background: url('{{ asset('assets1/images/background-wave-minimalist-modern-style_483537-5220.avif') }}') no-repeat center center; background-size: cover; height:50vh;">
        <div class="container">
            <h1>Welcome to Our Shop</h1>
            <p class="lead">Find the best products here at the best price</p>
            {{-- <a href="{{ route('filter.index') }}" class="btn border"
                style="background: linear-gradient(to left, #017267, #e6ebeb)">Shop Now</a> --}}
        </div>
    </section>

    <!-- Products Section -->
    <section class="products py-5">
        <div class="container">
            <h1 class="text-center mb-4">Products</h1>
            <div id="productsCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($products->chunk(4) as $key => $chunk)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <div class="row">
                                @foreach ($chunk as $product)
                                    <div class="col-md-3 mb-4">
                                        <div class="card h-100 shadow-sm">
                                            <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                                alt="{{ $product->name }}" class="card-img-top" loading="lazy">
                                            <div class="card-body d-flex flex-column">
                                                <h5 class="card-title">{{ $product->name }}</h5>
                                                <p class="card-text">${{ $product->price }}</p>
                                                <a href="{{ route('product.details', $product->id) }}"
                                                    class="btn btn-primary mt-auto">View Details</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#productsCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#productsCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-5">
        <div class="container text-center">
            <h1 class="mb-4">Categories</h1>
            <div id="categoryCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($categories->chunk(3) as $key => $categoryChunk)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <div class="row">
                                @foreach ($categoryChunk as $category)
                                    <div class="col-md-4 mb-3">
                                        <a href="{{ route('categories.show', $category->id) }}" class="btn">
                                            <div class="card">
                                                <img src="{{ asset('storage/' . $category->thumbnail) }}"
                                                    class="card-img-top" alt="{{ $category->name }}">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $category->name }}</h5>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#categoryCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#categoryCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    <!-- Brands Section -->
    <section class="brands py-5">
        <div class="container">
            <h1 class="text-center mb-4">Brands</h1>
            <div id="brandCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($brands->chunk(4) as $key => $chunkBrands)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <div class="row">
                                @foreach ($chunkBrands as $brand)
                                    <div class="col-md-3 mb-4">
                                        <a href="{{ route('brands.show', $brand->id) }}" class="btn mt-auto">
                                            <div class="card h-100 shadow-sm">
                                                <img src="{{ asset('storage/' . $brand->thumbnail) }}"
                                                    alt="{{ $brand->name }}" loading="lazy" class="card-img-top">
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#brandCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#brandCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    <!-- Contact Us Section -->
    <section class="py-5">
        <div class="container text-center">
            <h2 class="mb-4">Contact Us</h2>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form action="{{ route('contact.store') }}" method="POST" class="row g-3">
                @csrf
                <div class="col-md-6">
                    <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                </div>
                <div class="col-md-6">
                    <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                </div>
                <div class="col-12">
                    <textarea name="message" class="form-control" placeholder="Your Message" rows="4" required></textarea>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </div>
            </form>
        </div>
    </section>

    <!-- Footer Start -->
    @include('frontend.partials.footer')
    <!-- Footer End -->

    <!-- Scripts -->
    @include('frontend.partials.script')
</body>

</html>
