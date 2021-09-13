<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Peepalike">
  <meta name="author" content="Peepalike">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Peepalike </title>
  <!-- Favicon -->
  <link rel="icon" href="{{ asset('eventadmin/img/brand/favicon.png') }}" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="{{ asset('eventadmin/vendor/nucleo/css/nucleo.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('eventadmin/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" type="text/css">

  <!-- Peepalike CSS -->
  <link rel="stylesheet" href="{{ asset('eventadmin/css/argon.css?v=1.2.0') }}" type="text/css">
  @yield('style')
</head>
<body>

  <div class="main-content" id="panel">
    @include('user.layout.topbar')
    <div class="user-content-start">
      @include('user.layout.header')
      @yield('content')
    </div>  
    @include('user.layout.footer')
  </div>
  @yield('modal')
  @include('user.layout.style')
  <script src="{{ asset('eventadmin/vendor/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('eventadmin/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('eventadmin/vendor/js-cookie/js.cookie.js') }}"></script>
  <script src="{{ asset('eventadmin/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
  <script src="{{ asset('eventadmin/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
  <!-- Optional JS -->
  <script src="{{ asset('eventadmin/vendor/chart.js/dist/Chart.min.js') }}"></script>
  <script src="{{ asset('eventadmin/vendor/chart.js/dist/Chart.extension.js') }}"></script>
  <!-- Peepalike JS -->
  <script src="{{ asset('eventadmin/js/argon.js?v=1.2.0') }}"></script>
  <script src="{{ asset('newtheme/js/user-main.js') }}"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   @yield('script')
</body>

</html>
