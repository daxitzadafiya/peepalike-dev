<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="It is a hotel booking website dashboard. It use for insert data in admin website.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="hosting, web hosting">
    <meta name="author" content="Al-azim himu">
    <!--== css link ==-->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/> <!--===== font awesome css link =====-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"/> <!--===== bootstrap css link =====-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="{{ asset('asset-event/css/commonDesign.css') }}"> <!--===== responsive css link =====-->
    <link rel="stylesheet" type="text/css" href="{{ asset('asset-event/css/entrepreneurship.css') }}"> <!--===== style.css link =====-->
    <link rel="stylesheet" type="text/css" href="{{ asset('asset-event/css/responsive.css') }}"> <!--===== responsive css link =====-->
    <!--== site title ==-->
    <title>Booking</title>
    <!--== favicon ==-->
    <link rel="icon" href="{{ asset('asset-event/favicon/favicon.png') }}" type="icon/ico" sizes="48x48">
</head>
<body>
    @yield('content')
    <div class="wrapper_overlay"><div></div></div> <!--========== wrapper overlay ==========-->
    <!--== javascript link ==-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> <!--===== jquery link =====-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script> <!--===== owl carousel js link =====-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>  <!--===== bootstrap js link =====-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script type="text/javascript" src="{{ asset('asset-event/js/commonScript.js') }}"></script> <!--===== common script js link =====-->
    <script type="text/javascript" src="{{ asset('asset-event/js/entrepreneurship.js') }}"></script> <!--===== custom js link =====-->
</body>
</html>