@extends('eventusers.layout.app')
@section('style')
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <style type="text/css">
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
    </style>
@endsection
@section('content')
    <!-- Header -->
    <div class="header pb-6 d-flex align-items-center" style="min-height: 50px; margin-bottom: 10px;">
     
    </div>
<!-- Page content -->
   <div class="container-fluid mt--6">
      <!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
              <h3 class="mb-0" style="width: 80%; float: left;">Users Location</h3>
            </div>
            <div class="card border-0">
             <div id="map" style="height: 600px;"></div>
            </div>
          </div>
          
        </div>
      </div>

    </div>
@endsection
@section('modal')

@endsection
@section('script')
  <!-- Optional JS -->
  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAL6Dg0qk25EiU3vstUKfnwNOEhE-G3vAM"></script> -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAL6Dg0qk25EiU3vstUKfnwNOEhE-G3vAM&callback=initMap&libraries=&v=weekly" async ></script>
  <script>

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
