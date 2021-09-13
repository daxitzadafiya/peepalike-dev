<!-- Left Menu -->
<span id="shadowbox" onClick="menuClose()"></span>
<nav>
    <button id="navBtnShow" onClick="menuOpen()">
        <div></div>
        <div></div>
        <div></div>
    </button>
    <ul id="listMenu">
      <span class="desktop" >
         <div class="menu-logo">
            <section id="navBtn" class="navBtnNew navOpen" onClick="menuClose()">
               <div></div>
               <div></div>
               <div></div>
            </section>
            <a href="{{ route('index') }}" class="logo-left signin"><img
                        style="width: 55%" src="{{ asset('frontend/assets/css/ufxforall/menu-logo.png') }}" alt=""></a>
            <label><a href="{{ route('login') }}" class="">
            <i aria-hidden="true" class="fa fa-user"></i>Sign In</a></label>
         </div>
         <div class="menu-left-new">
                <li><a href="/career/jobs/list">Jobs</a></li>
            <li><a href="{{ route('how-it-works') }}" class="">How it Work</a></li>
            <li><a href="{{ route('trust') }}" class="">Trust Safety & Insurance</a></li>
            <li><a href="{{ route('terms') }}" class="">Terms & Conditions</a></li>
            <li><a href="{{ route('legal') }}" class="">Legal</a></li>
            <li><a href="{{ route('faq') }}" class="">Faq</a></li>
            <b>
            <a href="{{ route('user.register') }}" class="">Sign up to Job</a>
            <a class="" href="{{ route('provider.register') }}">become a Service Provider</a>
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
            <b>
                   <li><a href="/career/jobs/list">Jobs</a></li>
            <a href="{{ route('user.register') }}" class="">Sign up to Job</a>
            <a class="" href="{{ route('provider.register') }}">become a Service Provider</a>
            </b>
         </div>
      </span>
    </ul>
</nav>
<!-- End: Left Menu-->
<!-- Top Menu -->
<div id="top-part" class="" style="background-color: #add8e6">
    <div class="top-part-inner">
        <div class="logo">
            <a href="{{ route('index') }}">
                <img style="width: 45%" src="{{ asset('frontend/assets/css/ufxforall/logo.png') }}" alt="">
            </a>
            <span class="top-logo-link"><a href="{{ route('about') }}" class="">About Us</a><a
                        href="{{ route('contact') }}" class="">Contact Us</a></span>
        </div>
        <div class="top-link">
         <span>
         <a href="{{ route('help') }}" class="">Help</a>
         <a href="{{ route('login') }}" class="">Sign In</a>
         </span>
        </div>
        <div style="clear:both;"></div>
    </div>
</div>
<!-- End: Top Menu-->