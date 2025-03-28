<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg navbar-light bg-primary"
    style="background: linear-gradient(to bottom, #017267, #e6ebeb)">
    <div class="container">
        <a class="navbar-brand" href="#">Electric Shop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto ">
                <li class="nav-item ">
                    <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ url('/about') }}">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ url('/contact') }}">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ url('/service') }}">Services</a>
                </li> &nbsp;
                {{-- <li class="nav-item">
                    <a class="nav-link" href="#">Testimonials</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Blog</a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ url('/index') }}">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/category') }}">Category</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/cart') }}">Cart</a>
                </li> --}}
                <li>
                    <a href="{{ route('cart.index') }}"><i class="fa-solid fa-cart-shopping fs-4 mt-2 text-black"></i></a>
                </li>&nbsp;&nbsp;


                @if (Route::has('login'))
                    <nav class="-mx-3 flex flex-1 justify-end">
                        @auth
                            {{-- @can('view dashboard') --}}
                                <a href="{{ route('dashboard') }}" class="btn btn-success">
                                    Dashboard
                                </a>&nbsp;&nbsp;
                            {{-- @endcan --}}

                            <!-- Logout button, visible only when user is logged in -->
                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-primary">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-danger">Login</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-warning">Register</a>&nbsp;
                            @endif
                        @endauth
                    </nav>
                @endif

            </ul>

        </div>
    </div>
</nav>
