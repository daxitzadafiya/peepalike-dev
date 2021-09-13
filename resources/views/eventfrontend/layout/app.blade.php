<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="It is a hotel booking website dashboard. It use for insert data in admin website.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="hosting, web hosting">
    <meta name="author" content="Al-azim himu">
     <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--== css link ==-->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/> <!--===== font awesome css link =====-->
    <link rel="stylesheet" href="{{ asset('frontendassets/css/bootstrap.min.css') }}"/> <!--===== bootstrap css link =====-->
    <link rel="stylesheet" href="{{ asset('frontendassets/css/owl.carousel.min.css') }}" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('frontendassets/css/owl.theme.default.min.css') }}" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontendassets/css/commonDesign.css') }}"> <!--===== responsive css link =====-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontendassets/css/style.css') }}"> <!--===== style.css link =====-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontendassets/css/responsive.css') }}"> <!--===== responsive css link =====-->
    <!--== site title ==-->
    <title>Booking</title>
    <!--== favicon ==-->
    <link rel="icon" href="{{ asset('frontendassets/favicon/favicon.png') }}" type="icon/ico" sizes="48x48">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontendassets/css/event.css') }}"> <!--===== style.css link =====-->
</head>
<body>
    @yield('content')
    <div class="wrapper_overlay"><div></div></div> <!--========== wrapper overlay ==========-->
    <!--== javascript link ==-->
    <script src="{{ asset('frontendassets/js/jquery.min.js') }}"></script> <!--===== jquery link =====-->
    <script src="{{ asset('frontendassets/js/bootstrap.bundle.min.js') }}"></script>  <!--===== bootstrap js link =====-->
    <script src="{{ asset('frontendassets/js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontendassets/js/commonScript.js') }}"></script> <!--===== common script js link =====-->
    <script type="text/javascript" src="{{ asset('frontendassets/js/custom.js') }}"></script> <!--===== custom js link =====-->
    <script type="text/javascript" src="{{ asset('frontendassets/js/event.js') }}"></script> <!--===== custom js link =====-->
</body>
</html>