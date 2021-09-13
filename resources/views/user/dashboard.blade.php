@extends('user.layout.app')
@section('style')
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
  <style type="text/css">
    /* Always set the map height explicitly to define the size of the div
      * element that contains the map. */
    #map {
      height: 100%;
    }
    .dashboard-content h6{
      font-size: 25px !important;
      font-weight: 600 !important;
      color: #000;
    }
    .dashboard-content hr{
      border-bottom: 1px solid #e4e2e2 !important;
    }
    .dashboard-content .card-body h5{
      font-size: 20px !important;
    }
  </style>
@endsection
@section('content')
   
    <!-- Header -->
    <div class="header pb-6 dashboard-content">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-12 col-md-12">
              <h6 class="h2 d-inline-block mb-0">Dashboard Overview</h6>
            </div>
            <hr>
            <div class="col-lg-6 col-5 text-right">
              {{-- <a href="#" class="btn btn-sm btn-neutral">New</a>
              <a href="#" class="btn btn-sm btn-neutral">Filters</a> --}}
            </div>
          </div>
          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-12 col-md-12">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">General Reports</h5>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-primary mr-2 text-bold">Event title : Lorem ipsum dolor sit amet</span>
                    <p class="">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eget congue turpis, at tempor felis. Suspendisse potenti. Etiam ut libero metus. Sed mattis congue fermentum. Nunc magna turpis, commodo eget lacus vitae, tincidunt aliquet augue. Praesent rutrum gravida rhoncus. Aenean euismod, neque quis elementum dignissim, nisi enim interdum lectus, ac finibus est arcu id sapien. Donec ut nunc eget nisi suscipit consequat. Duis est est, fringilla eget risus eget, molestie aliquam nunc. Curabitur molestie erat eu ligula maximus aliquet et lacinia lectus. Donec iaculis, sapien sed scelerisque varius, arcu tellus dignissim lectus, vel rhoncus ex tellus eget nibh. Sed risus nisl, fermentum non rhoncus luctus, mattis vitae massa.</p>
                  </p>
                </div>
              </div>
            </div>
            {{-- <div class="col-xl-12 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Male</h5>
                      <span class="h2 font-weight-bold mb-0 auto-count">{{ $male_user }}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                        <i class="ni ni-chart-pie-35"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                    <span class="text-nowrap">Since last month</span>
                  </p>
                </div>
              </div>
            </div> --}}
          </div>
        </div>
      </div>
    </div>
@endsection
@section('script')
  <!-- Optional JS -->
  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAL6Dg0qk25EiU3vstUKfnwNOEhE-G3vAM"></script> -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAL6Dg0qk25EiU3vstUKfnwNOEhE-G3vAM&callback=initMap&libraries=&v=weekly" async ></script>
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script> --}}
  <script>
      // Number.prototype.format = function(n) {
      //     var r = new RegExp('\\d(?=(\\d{3})+' + (n > 0 ? '\\.' : '$') + ')', 'g');
      //     return this.toFixed(Math.max(0, Math.floor(n))).replace(r, '$&,');
      // };
      // $(document).ready(function(){
      //   $('.auto-count').each(function () {
      //       $(this).prop('counter', 0).animate({
      //           counter: $(this).text()
      //       }, {
      //           duration: 10000,
      //           easing: 'easeOutExpo',
      //           step: function (step) {
      //               $(this).text('' + step.format());
      //           }
      //       });
      //   });
      // })
      var map;
      function initMap() {
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 2,
          center: { lat: -1.4325349, lng: 36.992207 },
        });
        // Set LatLng and title text for the markers. The first marker (Boynton Pass)
        // receives the initial focus when tab is pressed. Use arrow keys to
        // move between markers; press tab again to cycle through the map controls.
        const tourStops = [
            <?php 
             foreach ($users as $key => $value) { 
            ?>
            [{ lat: <?php echo $value->latitude ?>, lng: <?php echo $value->longitude ?> }, "<?php echo $value->first_name.' '.$value->last_name ?>"],
            
          <?php }
          ?>
        ];
        // Create an info window to share between markers.
        const infoWindow = new google.maps.InfoWindow();
        // Create the markers.
        tourStops.forEach(([position, title], i) => {
          const marker = new google.maps.Marker({
            position,
            map,
            title: `${i + 1}. ${title}`,
            label: `${i + 1}`,
            optimized: false,
          });
          // Add a click listener for each marker, and set up the info window.
          marker.addListener("click", () => {
            infoWindow.close();
            infoWindow.setContent(marker.getTitle());
            infoWindow.open(marker.getMap(), marker);
          });
        });
      }
    </script>
@endsection