<style>
  #children{
    list-style: none;
    cursor: pointer;
  }
  #dropdown{
    cursor: pointer;
  }
  .drop-down-icon,.drop-up-icon{
    text-align: end;
  }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(()=> {
    $("#dropdown").on("click" , () => {
      if($("#children").css("display") === "block"){
        $("#children").css("display","none")
        $('.drop-down-icon').css("display","block")
        $('.drop-up-icon').css("display","none")
      }
      else{
        $("#children").css("display","block")
        $('.drop-up-icon').css("display","block")
        $('.drop-down-icon').css("display","none")
      }
    })
  })
</script>
<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs user-left-menu" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <div class="user-profile">
            {{-- <div class="sidenav-header  align-items-center">
              <a class="navbar-brand" href="javascript:void(0)">
                <img src="{{ asset('eventadmin/img/brand/Peppalike.png') }}" class="navbar-brand-img" alt="..." style="width: 130px;">
              </a>
            </div> --}}
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                    @if(Auth::user()->is_avatar == '1')
                        <img src="{{ Auth::user()->image != null ? Auth::user()->image : '' }}">
                    @else
                        <img src="{{ Auth::user()->image != null ? url('/images/user_profile').'/'.Auth::user()->image : asset('eventadmin/img/theme/team-4.jpg') }}">
                    @endif
                </span>
                <div class="media-body  ml-2  d-none d-lg-block">
                  <span class="mb-0 text-sm user-name font-weight-bold">{{ (Auth::id() != null) ? Auth::user()->first_name ." ". Auth::user()->last_name : '' }}</span>
                </div>
              </div>
            </a>
          </div>
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link {{ Request::segment(2) === 'dashboard' ? 'active' : '' }}" href="{{ route('user.dashboard') }}">
                <i class="ni fa fa-home"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
            {{-- <li class="nav-item">
              <a class="nav-link {{ Request::segment(2) === 'chat' ? 'active' : '' }}" href="{{ route('user.chat') }}">
                <i class="ni ni-chat-round text-primary"></i>
                <span class="nav-link-text">Chat View</span>
              </a>
            </li> --}}
            <li class="nav-item">
              <a class="nav-link {{ Request::segment(2) === 'addEvent' ? 'active' : '' }}" href="{{ route('user.addEvent') }}">
                <i class="ni fa fa-plus-circle"></i>
                <span class="nav-link-text">Create Events</span>
              </a>
            </li>
            {{-- <li class="nav-item">
              <a class="nav-link {{ Request::segment(2) === 'categoryList' ? 'active' : '' }}" href="{{ route('user.categoryList') }}">
                 <i class="fa fa-bars text-yellow"></i>
                <span class="nav-link-text">Category</span>
              </a>
            </li>--}}
            <li class="nav-item">
              <a class="nav-link {{ Request::segment(2) === 'eventList' ? 'active' : '' }}" href="{{ route('user.eventList') }}">
                  <i class="ni ni-spaceship"></i>
                <span class="nav-link-text">My listings/Events</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ Request::segment(2) === 'addTicket' ? 'active' : '' }}" href="">
                <i class="ni fa fa-plus-circle"></i>
                <span class="nav-link-text">Create Tickets</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ Request::segment(2) === 'eventTicket' ? 'active' : '' }}" href="">
                <i class="ni ni-palette"></i>
                <span class="nav-link-text">My Bookings/Tickets</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ Request::segment(2) === 'profile' ? 'active' : '' }}" href="{{ route('user.profile') }}">
                <i class="ni ni-circle-08 text-pink"></i>
                <span class="nav-link-text">Profile</span>
              </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('eventusers.logout') }}">
                        <i class="ni ni-user-run text-orange"></i>
                    <span class="nav-link-text">Logout</span>
                </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

