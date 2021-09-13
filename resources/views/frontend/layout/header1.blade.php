<!-- Left Menu -->
<span id="shadowbox" onClick="menuClose()"></span>
<nav>
    <button id="navBtnShow" onClick="menuOpen()" style="background:transparent !important;">
        <div style="background:#fff !important;"></div>
        <div style="background:#fff !important;"></div>
        <div style="background:#fff !important;"></div>
    </button>
    <ul id="listMenu">
      <span class="desktop" >
         <div class="menu-logo">
            <section id="navBtn" class="navBtnNew navOpen" onClick="menuClose()">
               <div></div>
               <div></div>
               <div></div>
            </section>
            <!--<a href="{{ route('index') }}" class="logo-left signin"><img-->
            <!--            style="width: 60px;height:60px;" src="{{ asset('frontend/assets1/img/logo3.png') }}" alt=""></a>-->
            <label style="margin-top:-22px;"><a href="{{ route('login') }}" class="" style="">
            <i aria-hidden="true" class="fa fa-user"></i>Sign In</a></label>
         </div>
         <div class="menu-left-new">
                <li><a href="/career/jobs/list">Jobs</a></li>
            <li><a href="{{ route('how-it-works') }}" class="item">How it Work</a></li>
            <li><a href="{{ route('trust') }}" class="item">Trust Safety & Insurance</a></li>
            <li><a href="{{ route('terms') }}" class="item">Terms & Conditions</a></li>
            <li><a href="{{ route('legal') }}" class="item">Legal</a></li>
            <li><a href="{{ route('faq') }}" class="item">Faq</a></li>
            <b>
            <a href="{{ route('user.register') }}" class="" style="padding:5px;font-size:14px;color:#fff;border-color:#fff;">Sign up to Job</a>
            <a class="" href="{{ route('provider.register') }}" style="padding:5px;font-size:14px;color:#fff;border-color:#fff;">become a Service Provider</a>
            </b>
            <div style="clear:both;"></div>
         </div>
      </span>
        <span class="mobile">
         <div class="menu-logo">
            <section id="navBtn" class="navBtnNew navOpen" onClick="menuClose()">
               <div></div>
               <div></div>
               <div></div>
            </section>
            <img style="width: 55%" src="{{ asset('frontend/assets/img/menu-logo.png') }}" alt="">
         </div>
            <!-- Top Menu Mobile -->
         <div class="menu-left-new">
            <!-- End Top Menu Mobile -->
            <li><a href="{{ route('index') }}" class="active">Home</a></li>
            <li><a href="{{ route('about') }}" class="">About Us</a></li>
            <li><a href="{{ route('help') }}" class="">Help Center</a></li>
            <li><a href="{{ route('contact') }}" class="">Contact Us</a></li>
            <li><a href="{{ route('login') }}" class="">Login</a></li>
               <li><a href="/career/jobs/list">Jobs</a></li>
            <b>
            <a href="{{ route('user.register') }}" class="">Get a service provider</a>
            <a class="" href="{{ route('provider.register') }}">become a Service Provider</a>
            </b>
         </div>
      </span>
    </ul>
</nav>
<!-- End: Left Menu-->
<!-- Top Menu -->
<div id="top-part" class="" style="background-color: rgba(30, 67, 86, 0.95);height:68px;">
    <div class="top-part-inner">
        <!--<div class="logo" >-->
                <a href="/"
              ><img
                id="head-logo"
                src="{{ asset('frontend/assets1/img/logo3.png') }}"
                alt=""
                class="img-fluid"
                style="width: 60px; height: 60px;"
            /></a>
            <!--<span class="top-logo-link"><a href="{{ route('about') }}" class="">About Us</a><a-->
            <!--            href="{{ route('contact') }}" class="">Contact Us</a></span>-->
        <!--</div>-->
            <nav class="nav-menu float-right d-none d-lg-block" style="margin-right:90px;margin-top:5px;">
          <ul>
            <li class=""><a href="/">Home</a></li>
            <!--<li><a href="https://www.Readiwork.com/sign-up-user">Sign up</a></li>-->
               <li><a href="/career/jobs/list">Jobs</a></li>
               <li class="drop-down">
                   <a href="">Providers</a>
                   <ul>
                      
            <li><a href="https://www.Readiwork.com/sign-up-provider">Become a Provider</a></li>
            <li><a href="https://www.Readiwork.com/sign-up-user">Get a Provider</a></li>
                   </ul>
               </li>
            <!-- <li><a href="services.html">Sign Up</a></li> -->
            <li><a href="/contact-us">Contact Us</a></li>
            <li><a href="https://www.Readiwork.com/login-user">Login</a></li>
            <li class="drop-down">
              <a href="">More</a>
              <ul>
            <li><a href="/about-us">About Us</a></li>
              <li><a href="/how-it-works">How it Works</a></li>
              <li><a href="/trust-safety">Trust & Safety Insuarance</a></li>
              <li><a href="/terms-and-conditions">Terms & conditions</a></li>
              <li><a href="/legal">Legal</a></li>
              <li><a href="/faq">FAQs</a></li>
            <li><a href="/help">Help</a></li>
              </ul>
            </li>
           
          </ul>
        </nav>
        <!--<div class="top-link">-->
        <!-- <span>-->
        <!-- <a href="{{ route('help') }}" class="">Help</a>-->
        <!-- <a href="{{ route('login') }}" class="">Sign In</a>-->
        <!-- </span>-->
        <!--</div>-->
        <div style="clear:both;"></div>
    </div>
</div>

<style>
    #navBtnShow{
        display:none;
    }
    #head-logo{
        margin-top:1px !important;
    }
    @media only screen and (max-width:800px){
        #navBtnShow{
            display:block;
        }
    }
    /*.menu-left-new .item{*/
    /*    padding:0 !important;*/
    /*    margin:0 !important;*/
    /*}*/
    nav{
        line-height:2em !important;
    }
    .header-page,.header-page-b,.header-page-a,.header-page-c,.header-page-d,.header-page-e{
        color:#105a80 !important;
    }
    
    
    nav ul#listMenu.listOpen{
        background:#365869;
    }
    nav ul#listMenu.listOpen li a {
        color:#fff;
        font-family:"Montserrat",sans-serif;
    }
    .menu-logo{
        background:none;
    }
    .sign-in-rider span a,.sign-in-driver span a{
        background:#1e4356 !important;
    }
</style>
<!-- End: Top Menu-->