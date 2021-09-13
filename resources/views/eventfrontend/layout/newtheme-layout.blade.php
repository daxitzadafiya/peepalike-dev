<!DOCTYPE HTML>
<html lang="en">
<head>
        <!--=============== basic  ===============-->
        <meta charset="UTF-8">
           <title>Peepalike | Events Near You- @yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="robots" content="index, follow"/>
        <meta name="keywords" content="events, events near me, upcoming events"/>
        <meta name="description" content="Find events in your area with new people. Meet up and go to the movies, grab coffee, or just hang out at home. Join now!"/>
		<meta name="google-site-verification" content="UiQkUsoiSJWSwmAwLH23bKcoiqhRC0HEWFootidZbvA" />
        <!--=============== css  ===============-->
        <link type="text/css" rel="stylesheet" href="{{ asset('newtheme/css/reset.css') }}">
        <link type="text/css" rel="stylesheet" href="{{ asset('newtheme/css/plugins.css') }}">
        <link type="text/css" rel="stylesheet" href="{{ asset('newtheme/css/style.css') }}">
        <link type="text/css" rel="stylesheet" href="{{ asset('newtheme/css/color.css') }}">
        <!--=============== favicons ===============-->
        <link rel="shortcut icon" href="{{ asset('newtheme/images/favicon.ico') }}">
		<script data-ad-client="ca-pub-8279524562612194" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <style>
            .phone-form {
                display: none;
                position: fixed;
                z-index: 1;
                padding-top: 100px;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgb(0,0,0);
                background-color: rgba(0,0,0,0.4);
            }
            .modal-content {
                background-color: #fefefe;
                margin: auto;
                padding: 20px;
                border: 1px solid #888;
                width: 100%;
            }
            .close-popup {
                color: #908a8a;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }
            .close-popup:hover,
            .close-popup:focus {
                color: #000;
                text-decoration: none;
                cursor: pointer;
            }
            .close{
                opacity: 0.7 !important;
            }
            .sign-in-user .modal-dialog{
                margin: 160px auto;
            }
            .sign-in .modal-header{
                padding: 36px 10px 0px 10px;
            }
            .modal-backdrop.in{
                display: none !important;
                opacity: 0 !important;
            }
            .login-options-wrapper{
                display: inline-grid;
            }
            .login-options-wrapper button,.login-options-wrapper a,.login-options-wrapper .register-link{
                margin: 10px 0px;
            }
            .login-options-wrapper button,
            .login-options-wrapper .social_login a{
                background: #ffffff;
                border: 2px solid #667180;
                border-radius: 50px;
                padding: 14px 10px 14px 0;
                color: #667180;
                text-transform: uppercase;
                font-weight: 600;
                letter-spacing: 1px;
                width: 320px;
                max-width: 100%;
            }
            .login-options-wrapper img,.login-options-wrapper svg{
                padding: 0 13px 0 20px;
                float: left;
            }
            .more-option-link{
                text-decoration: underline;
                text-transform: uppercase;
                cursor: pointer !important;
            }
            .login-wrapper hr{
                width: 348px;
                color: #667180;
                border-top: 1px solid #e5e5e5;
                margin: auto;
            }
            .more-option-wrapper{
                margin-bottom: 15px;
            }
            .sign-in .modal-header p{
                font-size: 13px;
                margin: 10px 20px 0;
            }
            .more-option-wrapper a{
                color: grey;
                text-decoration: underline;
            }
            .sign-in h3{
                font-style: italic;
                font-weight: 600;
                margin: 24px 0px;
            }
            .sign-in .modal-dialog{
                width: 412px;
            }
            .sign-in-close i{
                margin: 7px 15px;
                transition-duration: .2s;
            }
            .sign-in-close i:hover{
                transform: rotate(-90deg);
            }
            .sign-in .app-link{
                padding-bottom: 18px;
            }
            .sign-in .app-link img{
                width: 132px;
            }
            .sign-in .app-link .app-store img{
                width: 108px;
            }
            .btn{
                outline:none !important;
            }
            .scroll-nav-wrapper-info{
                z-index: -1 !important;
            }
            .event-detail-banner .slick-list.draggable{
                height: 200px !important;
            }
            .event-detail-banner .slick-list.draggable img{
                height: 200px;
                object-fit: cover;
            }
            @media (max-width: 767px) and  (min-width: 432px){
                .create-event-nav{
                    display: block !important;
                }
            }
            @media (max-width: 432px) and  (min-width: 319px){
                .home-blog-wrapper .slider-container .hero-section-wrap {
                    padding: 125px 0;
                }
                .home-blog-wrapper .sw-btn{
                    width: 20px;
                    height: 20px;
                    line-height: 20px;
                }
                .home-blog-wrapper .slider-container-wrap .sw-btn{
                    top:30%;
                }
                .home-blog-wrapper.hero-section .intro-item h2 {
                    font-size: 27px;
                }
                .home-blog-wrapper .sw-btn.swiper-button-prev {
                    left: 22px;
                }
                .home-blog-wrapper .sw-btn.swiper-button-next {
                    right: 22px;
                }
                .tranding-events-wrapper .geodir-category-content h3, .tranding-events-wrapper .geodir-category-content p {
                    width: 204px;
                }
                .category-icon-listing{
                    width: 355px;
                    left: 34px;
                }
                .sign-in .modal-dialog {
                    width: 304px;
                }
                .login-options-wrapper button {
                    width: 272px;
                    font-size: 12px;
                }
                .show-reg-form {
                    top: 43px;
                }
                .nav-button {
                    top: 48%;
                    left: 64%;
                    width: 15px;
                    height: 20px;
                }
                .nav-button-wrap {
                    height: 30px;
                    width: 30px;
                    top: 37px;
                    margin-right: 6px;
                }
                .sign-in .app-link img {
                    width: 122px;
                }
                .sign-in .modal-body{
                    padding: 0;
                }
                .create-event-nav{
                    display: block !important;
                }
                .event-detail-banner .sw-btn.swiper-button-prev {
                    left: 18px;
                }
                .event-detail-banner .sw-btn.swiper-button-next {
                    right: 18px;
                }
                .event-detail-banner .sw-btn{
                    width: 26px;
                    height: 26px;
                    line-height: 26px;
                }
            }
        </style>
    </head>
    <body>
        <!--loader-->
        <div class="loader-wrap">
            <!-- <div class="pin"></div>
            <div class="pulse"></div> -->
        </div>
        <!--loader end-->
        <!-- Main  -->
        <div id="main">
            <!-- header-->
            <header class="main-header dark-header fs-header sticky">
                <div class="header-inner">
                    <div class="logo-holder">
                        <a href="{{ Request::is('/') ? 'act-link' : '' }}" href="{{url('/')}}" style="font-size: 30px;font-weight: bold;color: white;"><span style="color:#4DB7FE">P</span>eepAlike</a>
                    </div>
                    <a href="" class="add-list" data-toggle="modal" data-target="#sign-in-user">Create Event <span><i class="fa fa-plus"></i></span></a>
                    <div class="show-reg-form modal-open" data-toggle="modal" data-target="#sign-in-user">Sign In | Register</div>
                    <!-- nav-button-wrap-->
                    <div class="nav-button-wrap color-bg">
                        <div class="nav-button">
                            <span></span><span></span><span></span>
                        </div>
                    </div>
                    <!-- nav-button-wrap end-->
                    <!--  navigation -->
                    <div class="nav-holder main-menu">
                        <nav>
                            <ul>
                                <li>
                                    <a class="{{ Request::is('/') ? 'act-link' : '' }}" href="{{url('/')}}">Home</a>
                                </li>
                                <li>
                                    <a class="{{ Request::is('events') ? 'act-link' : '' }}" href="{{url('/events')}}">Events</a>
                                </li>
                                <li>
                                    <a class="{{ Request::is('about') ? 'act-link' : '' }}" href="{{url('/about')}}">About Us</a>
                                </li>
                                <li>
                                    <a class="{{ Request::is('blogs') ? 'act-link' : '' }}" href="{{url('/blogs')}}">Blogs</a>
                                </li>
                                <li>
                                    <a class="{{ Request::is('faq') ? 'act-link' : '' }}" href="{{url('/faq')}}">FAQ</a>
                                </li>
                                <li>
                                    <a class="{{ Request::is('contact') ? 'act-link' : '' }}" href="{{url('/contact')}}">Contact Us</a>
                                </li>
                                <li>
                                    <a href="" class="create-event-nav" style="display: none" data-toggle="modal" data-target="#sign-in-user">Create Event</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <!-- navigation  end -->
                </div>
            </header>
            <!--  header end -->
            <!-- wrapper -->
            <div id="wrapper">
                <!-- Content-->
                <div class="content">
                    @yield('content')
                    <section class="sign-in">
                        <div class="modal fade sign-in-user" id="sign-in-user" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <button type="button" class="close sign-in-close" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-times-circle" aria-hidden="true"></i>
                                </button>
                                <div class="modal-header">
                                  <h3 class="modal-title" id="exampleModalLabel">GET STARTED</h3>
                                  <p>By clicking Log In, you agree to our terms. Learn how we process your data in our Privacy policy and Cookie Policy.</p>
                                </div>
                                <div class="modal-body">
                                    <div class="login-wrapper">
                                        <div class="login-options-wrapper">
                                            <div class="social_login">
                                                <a href="{{ route('login.google') }}" class="btn"><img src="{{ asset('images/bg/google-icon.svg')}}" alt="google">Login with Google</a>
                                            </div>
                                            <a href="javascript:void(0)" class="more-option-link">More Options</a>
                                            <div class="more-option-wrapper" style="display: none;">
                                                <div class="social_login">
                                                    <a href="{{ route('login.facebook') }}" class="btn"><img src="{{ asset('images/bg/facebook.svg')}}" alt="facebook">Login with Facebook</a>
                                                </div>
                                                <div>
                                                    <button class="btn signin-phone" id="loginWithPhone"><img src="{{ asset('images/bg/message.svg')}}" alt="message"> Login with Phone Number</button>
                                                </div>
                                                <div class="register-link">
                                                    <a href="">Trouble Logining in?</a>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="app-link">
                                            <h3>GET THE APP!</h3>
                                            <div class="app-link-wrapper">
                                                <a href="https://play.google.com/store/apps/details?id=com.app.peepalike&showAllReviews=true" class=""><img src="{{asset('images/bg/play-store.webp')}}" alt="play-store"></a>
                                                <a href="https://apps.apple.com/ke/app/peepalike/id1560568386" class="app-store"  style="margin-left:20px"><img src="{{asset('images/bg/apple-store.webp')}}" alt="apple-store"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="sign-in-user phone-form" id="sign-with-phoneno" role="dialog" aria-labelledby="mobile-sign" aria-hidden="true">
                            <div class="modal-dialog modal-content" role="document">
                                <button type="button" class="close close-popup sign-in-close" data-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                                </button>
                                <div class="modal-header">
                                <h3 class="modal-title number-validate" id="mobile-sign">Enter your mobile number</h3>
                                </div>
                                <div class="modal-body">
                                    <div class="login-wrapper">
                                        <div class="login-options-wrapper">
                                            <div class="form-group">
                                                <input type="text" name="mobile_no" id="mobile_no" class="form-control" onkeypress="return IsNumeric(event);" maxlength="10">
                                            </div>
                                            <p>When you tap "Continue", Peepalike will send a text with a verification code. Message and data rates may apply. The verified phone number can be used to login</p>
                                            <div>
                                                <button class="btn btn-primary" onclick="loginUser()">Continue</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <!-- Content end -->
            </div>
            <!-- wrapper end -->
            <!--footer -->
            <footer class="main-footer dark-footer  ">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="footer-widget fl-wrap">
                                <h3>About Us</h3>
                                <div class="footer-contacts-widget fl-wrap">
                                    <p> Peepalike is a social app that lets you meet new people in your area for adventures. Whether you want to go to the park, grab coffee, or just hang out at home Peepalike has a wide variety of different events- all with one goal: making friends! </p>
                                    <ul  class="footer-contacts fl-wrap">
                                        <li><span><i class="fa fa-envelope-o"></i> Mail :</span><a href="#" target="_blank">info@peepalike.com</a></li>


                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="footer-widget fl-wrap">
                                <h3>Subscribe</h3>
                                <div class="subscribe-widget fl-wrap">
                                    <p>The last thing we want is for you to miss out on our upcoming events. To make sure this doesn't happen, click the button below and subscribe to our email list so that you can stay in-the-know about all of the amazing things happening Near You!</p>
                                    <div class="subcribe-form">
                                        <form id="subscribe">
                                            <input class="enteremail" name="email" id="subscribe-email" placeholder="Email" spellcheck="false" type="text">
                                            <button type="submit" id="subscribe-button" class="subscribe-button"><i class="fa fa-rss"></i> Subscribe</button>
                                            <label for="subscribe-email" class="subscribe-message"></label>
                                        </form>
                                    </div>
                                </div>
                                <div class="footer-widget fl-wrap">
                                    <div class="footer-menu fl-wrap">
                                        <ul>
                                            <li>

											<a class="{{ Request::is('about') ? 'act-link' : '' }}" href="{{url('/about')}}">About Us</a>

											</li>
                                            <li><a href="#">Submit Event</a></li>
                                            <li>

											 <a class="{{ Request::is('events') ? 'act-link' : 'not' }}" href="{{url('/events')}}">All Events</a>

											</li>
                                            <li>


											 <a class="{{ Request::is('faq') ? 'act-link' : '' }}" href="{{url('/faq')}}">FAQ</a>


											</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sub-footer fl-wrap">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="about-widget">
                                    <a href="{{ Request::is('/') ? 'act-link' : '' }}" href="{{url('/')}}" style="font-size: 25px;font-weight: bold;color: white;float: left;">
									<span style="color:#4DB7FE">P</span>eepAlike</a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="copyright"> &#169; Peepalike {{ date('Y') }} .  All rights reserved.</div>
                            </div>
                            <div class="col-md-4">
                                <div class="footer-social">
                                    <ul>
                                        <li><a href="#" target="_blank" ><i class="fa fa-facebook-official"></i></a></li>
                                        <li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#" target="_blank" ><i class="fa fa-chrome"></i></a></li>
                                        <li><a href="#" target="_blank" ><i class="fa fa-vk"></i></a></li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!--footer end  -->
            <a class="to-top"><i class="fa fa-angle-up"></i></a>
        </div>
        <!-- Main end -->
        <!--=============== scripts  ===============-->
        <script type="text/javascript" src="{{ asset('newtheme/js/jquery.min.js') }}"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="{{ asset('newtheme/js/plugins.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/ImageScroll.js') }}"></script>
        <script type="text/javascript" src="{{ asset('newtheme/js/scripts.js') }}"></script>
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyCFgomoZjQBBtXSX8yNGTXi2E0YZHkig_s"></script>
        @yield('script')
        <script>
            $('.show-reg-form').click(()=>{
                $('.scroll-nav-wrapper').addClass('scroll-nav-wrapper-info');
            })
            $('.sign-in-close').click(()=>{
                location.reload(true);
            })
            var modal = document.getElementById("sign-with-phoneno");
            var btn = document.getElementById("loginWithPhone");
            var span = document.getElementsByClassName("close-popup")[0];
            btn.onclick = function() {
                $('#sign-in-user').modal('hide');
                modal.style.display = "block";

            }
            span.onclick = function() {
            modal.style.display = "none";
            }
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
            function loginUser(){
                alert('Login successfully!');
                window.location.href = '/user/dashboard'
            }
            $('.more-option-link').on('click',function(){
                $('.more-option-wrapper').toggle();
            })
            $('.signin-phone').on('click',function(){
                $('#sign-in-user').modal('hide');
                $('#sign-with-phoneno').modal('show');
            })
            function IsNumeric(event){
                var keycode = event.which;
                if (!(keycode >= 48 && keycode <= 57)) {
                    event.preventDefault();
                }
            }
        </script>
    </body>
</html>
