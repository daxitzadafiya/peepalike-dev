<link href="{{ asset('frontend/assets1/img/favicon.png') }}" rel="icon" />
    <link href="{{ asset('frontend/assets1/img/apple-touch-icon.png') }}" rel="apple-touch-icon" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,700,700i&display=swap"
      rel="stylesheet"
    />

    <!-- Vendor CSS Files -->


<header id="header" class="fixed-top header-transparent" style="height:65px;">
      <div class="container">
        <div class="logo float-left">
          <h1 class="text-light">
            <!-- image logo -->
            <a href="/"
              ><img
                id="head-logo"
                src="{{ asset('frontend/assets1/img/logo3.png') }}"
                alt=""
                class="img-fluid"
                style="width: 60px; height: 60px;"
            /></a>
            <!-- <a href="index.html"><h3 style="max-width:70%;font-family:montserrat,sans-serif;font-size:16px;">Readiwork</h3></a> -->
          </h1>
        </div>
      
        <nav class="nav-menu float-right d-none d-lg-block">
          <ul>
            <li class="active"><a href="/">Home</a></li>
            <li><a href="/about-us">About Us</a></li>
               <li><a href="/career/jobs/list">Jobs</a></li>
            <li><a href="https://www.Readiwork.com/sign-up-user">Sign up</a></li>
            <!-- <li><a href="services.html">Sign Up</a></li> -->
            <li><a href="/help">Help</a></li>
            <li><a href="/contact-us">Contact Us</a></li>
            <li class="drop-down">
              <a href="">More</a>
              <ul>
              <li><a href="/how-it-works">How it Works</a></li>
              <li><a href="/trust-safety">Trust & Safety Insuarance</a></li>
              <li><a href="/terms-and-conditions">Terms & conditions</a></li>
              <li><a href="/legal">Legal</a></li>
              <li><a href="/faq">FAQs</a></li>
              </ul>
            </li>
           
          </ul>
        </nav>
        <!-- .nav-menu -->
      </div>
      </header>
      <style>
          button.mobile-nav-toggle{
              background:transparent !important;
          }
      </style>