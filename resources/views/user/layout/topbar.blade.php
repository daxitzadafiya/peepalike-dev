 <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand border-bottom user-side-nav" >
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Search form -->
          <!-- Navbar links -->
          {{-- <div class="sidenav-header  align-items-center">
              <a class="navbar-brand" href="javascript:void(0)">
                <img src="{{ asset('eventadmin/img/brand/Peppalike.png') }}" class="navbar-brand-img" alt="..." style="width: 130px;">
              </a>
            </div> --}}
          <div class="nav-item d-xl-none nav-side-option">
            <!-- Sidenav toggler -->
            <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
              <div class="sidenav-toggler-inner">
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
              </div>
            </div>
          </div>
          <ul class="navbar-nav align-items-center  ml-md-auto top-option">
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
          </ul>
          <ul class="navbar-nav align-items-center  ml-auto ml-md-0 user-detail">
            <li class="nav-item dropdown">
              <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center">
                  <span class="avatar avatar-sm rounded-circle">
                      @if(Auth::user()->is_avatar == 1)
                      <img src="{{ Auth::user()->image != null ? Auth::user()->image : '' }}">
                      @else
                      <img src="{{ Auth::user()->image != null ? url('/images/user_profile').'/'.Auth::user()->image : asset('eventadmin/img/theme/team-4.jpg') }}">
                      @endif
                  </span>
                  <div class="media-body ml-4 d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold">My Account</span>
                  </div>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-right ">
                <a href="#" class="dropdown-item">
                  <i class="ni ni-single-02"></i>
                  <span>My profile</span>
                </a>
                {{-- <div class="dropdown-divider"></div>
                <a href="{{ route('eventusers.logout') }}" class="dropdown-item">
                  <i class="ni ni-user-run"></i>
                  <span>Logout</span>
                </a> --}}
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Header -->
