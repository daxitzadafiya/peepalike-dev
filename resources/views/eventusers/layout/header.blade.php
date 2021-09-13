<style>
    #children{
      list-style: none;
      cursor: pointer;
    }
    #dropdown{
      cursor: pointer;
    }
    #dropdown1{
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
  <script type="text/javascript">
    $(document).ready(()=> {
      $("#dropdown1").on("click" , () => {
        if($("#children1").css("display") === "block"){
          $("#children1").css("display","none")
          $('.drop-down-icon').css("display","block")
          $('.drop-up-icon').css("display","none")
        }
        else{
          $("#children1").css("display","block")
          $('.drop-up-icon').css("display","block")
          $('.drop-down-icon').css("display","none")
        }
      })
    })
  </script>
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
      <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header  align-items-center">
          <a class="navbar-brand" href="javascript:void(0)">
            <img src="{{ asset('eventadmin/img/brand/Peppalike.png') }}" class="navbar-brand-img" alt="..." style="width: 130px;">
          </a>
        </div>
        <div class="navbar-inner">
          <!-- Collapse -->
          <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Nav items -->
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link {{ Request::segment(2) === 'dashboard' ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                  <i class="ni ni-tv-2 text-primary"></i>
                  <span class="nav-link-text">Dashboard</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::segment(2) === 'chat' ? 'active' : '' }}" href="{{ route('admin.chat') }}">
                  <i class="ni ni-chat-round text-primary"></i>
                  <span class="nav-link-text">Chat View</span>
                </a>
              </li>

              <li class="nav-item" id="dropdown">
                <a class="nav-link">
                  <i class="fas fa-blog text-yellow"></i>
                  <span class="nav-link-text">Events</span>
                  <i class="fa fa-caret-down drop-down-icon"></i>
                  <i class="fa fa-caret-up drop-up-icon" style="display: none"></i>
                </a>
                <ul id="children" style="display: none">
                  <li class="nav-item">
                    <a class="nav-link {{ Request::segment(2) === 'eventList' ? 'active' : '' }}" href="{{ route('admin.eventList') }}">
                      <i class="fas fa-blog text-yellow"></i>
                      <span class="nav-link-text">All Event</span>
                    </a>
                  </li>
                  <li class="nav-item" >
                    <a class="nav-link {{ Request::segment(2) === 'blog/categoryList' ? 'active' : '' }}" href="{{ route('admin.eventCategoryList') }}">
                      <i class="fas fa-stream text-yellow"></i>
                      <span class="nav-link-text">Event Category</span>
                    </a>
                  </li>

                </ul>
              </li>

              {{-- <li class="nav-item">
                <a class="nav-link {{ Request::segment(2) === 'eventList' ? 'active' : '' }}" href="{{ route('admin.eventList') }}">
                  <i class="ni ni-spaceship"></i>
                  <span class="nav-link-text">Events</span>
                </a>

              </li> --}}
              <li class="nav-item">
                <a class="nav-link {{ Request::segment(2) === 'hangoutList' ? 'active' : '' }}" href="{{ route('admin.hangoutList') }}">
                  <i class="ni ni-bullet-list-67 text-default"></i>
                  <span class="nav-link-text">Hangout</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::segment(2) === 'usersList' ? 'active' : '' }}" href="{{ route('admin.usersList') }}">
                   <i class="ni ni-single-02 text-yellow"></i>
                  <span class="nav-link-text">Users</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::segment(2) === 'userStatusList' ? 'active' : '' }}" href="{{ route('admin.userStatusList') }}">
                   <i class="fa fa-address-card text-yellow"></i>
                  <span class="nav-link-text">User Status</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::segment(2) === 'user-report' ? 'active' : '' }}" href="{{ route('admin.userReport') }}">
                   <i class="fa fa-address-card text-yellow"></i>
                  <span class="nav-link-text">User Report</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::segment(2) === 'usersLocations' ? 'active' : '' }}" href="{{ route('admin.usersLocations') }}">
                  <i class="ni ni-pin-3 text-primary"></i>
                  <span class="nav-link-text">Users Location</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::segment(2) === 'categoryList' ? 'active' : '' }}" href="{{ route('admin.categoryList') }}">
                   <i class="fa fa-bars text-yellow"></i>
                  <span class="nav-link-text">Category</span>
                </a>
              </li>
              <li class="nav-item" id="dropdown1">
                <a class="nav-link">
                  <i class="fas fa-blog text-yellow"></i>
                  <span class="nav-link-text">Blogs</span>
                  <i class="fa fa-caret-down drop-down-icon"></i>
                  <i class="fa fa-caret-up drop-up-icon" style="display: none"></i>
                </a>
                <ul id="children1" style="display:none">
                  <li class="nav-item">
                    <a class="nav-link {{ Request::segment(2) === 'blogList' ? 'active' : '' }}" href="{{ route('admin.blogList') }}">
                      <i class="fas fa-blog text-yellow"></i>
                      <span class="nav-link-text">All Blogs</span>
                    </a>
                  </li>
                  <li class="nav-item" >
                    <a class="nav-link {{ Request::segment(2) === 'blog/categoryList' ? 'active' : '' }}" href="{{ route('admin.blogCategoryList') }}">
                      <i class="fa fa-bars text-yellow"></i>
                      <span class="nav-link-text">Category</span>
                    </a>
                  </li>
                  <li class="nav-item" >
                    <a class="nav-link {{ Request::segment(2) === 'blog/tagList' ? 'active' : '' }}" href="{{ route('admin.blogTagList') }}">
                      <i class="fa fa-tag text-yellow"></i>
                      <span class="nav-link-text">Tags</span>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
            <!-- Divider -->

            <hr class="my-3">
            <!-- Heading -->
            <h6 class="navbar-heading p-0 text-muted">
              <span class="docs-normal">Premium and Payment</span>
            </h6>
            <!-- Navigation -->
            <ul class="navbar-nav mb-md-3">

              <li class="nav-item">
                <a class="nav-link {{ Request::segment(2) === 'premiumList' ? 'active' : '' }}" href="{{ route('admin.premiumList') }}">
                    <i class="ni ni-circle-08 text-pink"></i>
                  <span class="nav-link-text">Premium</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::segment(2) === 'admin-tranactions' ? 'active' : '' }}" href="{{ route('admin.adminTransactions') }}">
                    <i class="ni ni-ui-04"></i>
                  <span class="nav-link-text">Admin Transaction</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::segment(2) === 'transactionsList' ? 'active' : '' }}" href="{{ route('admin.transactionsList') }}">
                  <i class="ni ni-palette"></i>
                  <span class="nav-link-text">User Transactions</span>
                </a>
              </li>
                <li class="nav-item">
                <a class="nav-link {{ Request::segment(2) === 'premiumUsersList' ? 'active' : '' }}" href="{{ route('admin.premiumUsersList') }}">
                  <i class="ni ni-chart-pie-35"></i>
                  <span class="nav-link-text">Premium Users</span>
                </a>
              </li>

            </ul>
            <hr class="my-3">
            <!-- Heading -->
            <h6 class="navbar-heading p-0 text-muted">
              <span class="docs-normal">Settings </span>
            </h6>
            <!-- Navigation -->
            <ul class="navbar-nav mb-md-3">
              <li class="nav-item">
                <a class="nav-link" href="#" target="_blank">
                     <i class="ni ni-planet text-orange"></i>
                  <span class="nav-link-text">Setting</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::segment(2) === 'staticPages' ? 'active' : '' }}" href="{{ route('admin.staticPages') }}">
                     <i class="fa fa-rocket text-orange"></i>
                  <span class="nav-link-text">Static Pages</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::segment(2) === 'customPush' ? 'active' : '' }}" href="{{ route('admin.customPush') }}">
                     <i class="fa fa-rocket text-orange"></i>
                  <span class="nav-link-text">Custom Push</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::segment(2) === 'pushNotificationsList' ? 'active' : '' }}" href="{{ route('admin.pushNotificationsList') }}">
                     <i class="fa fa-rocket text-orange"></i>
                  <span class="nav-link-text">Push Notification</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::segment(2) === 'changePassword' ? 'active' : '' }}" href="{{ route('admin.changePassword') }}">
                     <i class="fa fa-key text-orange"></i>
                  <span class="nav-link-text">Change Password</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('eventusers.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                     <i class="ni ni-key-25 text-info"></i>
                  <span class="nav-link-text">Logout</span>
                </a>
              </li>
            </ul>
            <form id="logout-form" action="{{ route('eventusers.logout') }}" method="GET" style="display: none;">
                      @csrf
                      </form>
          </div>
        </div>
      </div>
    </nav>

