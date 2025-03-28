{{-- <!doctype html>
<html lang="en">

<head>
  @include('backend.partials1.head')
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    @include('backend.partials1.sidebar')
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
     @include('backend.partials1.header')
      <!--  Header End -->
      <div class="container-fluid">
        <!--  Row 1 -->
      @yield('body')


  @include('backend.partials1.script')
  @stack('scripts')
</body>

</html> --}}
<!doctype html>
<html lang="en">

<head>
  @include('backend.partials1.head')
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    @include('backend.partials1.sidebar')
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      @include('backend.partials1.header')
      <!--  Header End -->
      <div class="container-fluid">
        <!--  Row 1 -->
        @yield('body')
      </div>
      <!-- Ensure to close all opened divs -->
    </div> <!-- End of body-wrapper -->
  </div> <!-- End of page-wrapper -->

  @include('backend.partials1.script')
  @stack('scripts')
</body>

</html>
