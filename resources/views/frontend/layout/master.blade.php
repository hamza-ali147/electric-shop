<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.partials.head')
   

</head>

<body>
    <!-- header section start -->
    @include('frontend.partials.navbar')
    <!-- header section end -->
   @yield('body')
    <!-- footer section start -->
    @include('frontend.partials.footer')
   
    @stack('scripts')
    @include('frontend.partials.script')
</body>

</html>
