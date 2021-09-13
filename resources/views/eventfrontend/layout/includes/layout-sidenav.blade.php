<div class="header_navigation_bar"> <!--========== header navigation bar start ==========-->
    <div class="row">
        <div class="col-12 col-sm-5 col-md-5 col-lg-3 order-1 order-sm-1 order-md-1 order-lg-1 order-xl-1">
            <div class="site_logo"> <!--========== header site logo start ==========-->
                <img src="{{ asset('frontendassets/logo/Peppalike PNG.png') }}" alt="logo" style="height: 8rem;wid width: 17rem;padding-top: 10px">
            </div> <!--========== header site logo end ==========-->
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-5 col-xl-6 order-3 order-sm-3 order-md-3 order-lg-2 order-xl-2">
        

            <nav class="header_navigation_menu">
                <!--========== header navigation menu start ==========-->
                <ul>
                    <li><a href="{{url('/')}}">home</a></li>
                    <li><a href="{{url('events')}}">Events</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Blogs</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </nav> <!--========== header navigation menu end ==========-->
        </div>
        <div class="col-12 col-sm-7 col-md-7 col-lg-4 col-xl-3 order-1 order-sm-2 order-md-2 order-lg-3 order-xl-3 padding_left_none">
            <div class="login"> <!--========== login start ==========-->
                <ul>
                    <li class="menu_bar_icon"><i class="fas fa-bars"></i></li>
                    <li class="menu_bar_close_icon"><i class="fas fa-times"></i></li>
                    <li><a href="#">login</a>&#124;<a href="#">register</a></li>
                    <li><button><a href="#">create event</a></button></li>
                </ul>
            </div> <!--==========login end ==========-->
        </div>
    </div>
</div> <!--========== header navigation bar end ==========-->