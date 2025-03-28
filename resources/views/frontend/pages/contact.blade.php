@extends('frontend.layout.master')
@section('body')
    <!-- Contact Us Section -->
    <section class="py-5">
        <div class="container text-center">
            <h2 class="mb-4">Contact Us</h2>

            <!-- Display success message if available -->
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
@endsection
