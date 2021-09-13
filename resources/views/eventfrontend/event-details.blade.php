@extends('eventfrontend.layout.newtheme-layout')
@section('title', 'Event Details')
@section('content')
<section class="gray-section" id="sec1">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="list-single-main-wrapper fl-wrap" id="sec2">
<<<<<<< HEAD
                    <!-- article> -->
=======
                    <!-- article> -->
>>>>>>> 43a80e1e974b21e2159a82ea6b511194730c5f62
                    <article>
                        <div class="list-single-main-media fl-wrap">
                            <a href="#"><img src="{{ asset('images/'.$event->event_image) }}" alt=""></a>
                        </div>
                        <div class="list-single-main-item fl-wrap">
                            <div class="list-single-main-item-title fl-wrap">
                                <h3>{{ $event->event_name }}</h3>
                            </div>
                            <p>
<<<<<<< HEAD
                               {{$event->description}}
=======
                                {!! $event->description !!}

>>>>>>> 43a80e1e974b21e2159a82ea6b511194730c5f62
                            </p>
                            <div class="post-opt">
                                <ul>
                                    <li><i class="fa fa-calendar-check-o"></i> <b>{{ $event->event_start_date }} - {{ $event->event_end_date }} ({{ $event->event_start_time }} - {{ $event->event_end_time }})</b></li>
                                    <br>
                                    <br>
<<<<<<< HEAD
                                    <li><i class="fa fa-location-arrow"></i> <b>{{ $event->vanue_name }}</b></li>
=======
                                    <li><i class="fa fa-location-arrow"></i> <b>{{ $event->venue_name }}</b></li>
>>>>>>> 43a80e1e974b21e2159a82ea6b511194730c5f62
                                    <br>
                                    <br>
                                    <li><i class="fa fa-map-marker"></i> <b>{{ $event->address }}</b></li>
                                </ul>
                            </div>
                            <span class="fw-separator"></span>
                            <div class="list-single-tags tags-stylwrap blog-tags">
                                <button class="btn  big-btn color-bg flat-btn" style="border:none">Buy Ticket<i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                            </div>
                          <!--   <div k8class="share-holder hid-share">
                                <div class="showshare"><span>Share </span><i class="fa fa-share"></i></div>
                                <div class="share-container  isShare"></div>
                            </div> -->
                        </div>
                    </article>
                </div>
            </div>
            <!--box-widget-wrap -->
            <div class="col-md-4 event-detail-banner">
                <div class="box-widget-wrap">
                	<div class="list-single-main-wrapper fl-wrap">
                		<div class="list-single-main-item-title fl-wrap">
		                    <h3>Event Location</h3>
		                </div>
	                    <div class="map-container">
	                        <div id="singleMap"></div>
	                    </div>
                        <div class="" id="distance">
                            <button onClick="getLocation()">Get</button><p id="distance">Distance</p>
<<<<<<< HEAD
                            {{
                              $p =0;

                            }}

=======

>>>>>>> 43a80e1e974b21e2159a82ea6b511194730c5f62
                        </div>
                	</div>
                    <div class="list-single-main-media fl-wrap">
                        <div class="list-single-main-item-title fl-wrap">
                            <h3>Event Banners</h3>
                        </div>
                        <div class="single-slider-wrapper fl-wrap">
                            <div class="single-slider fl-wrap"  >
                                @foreach($banners as $banner)
                                <div class="slick-slide-item"><img src="{{ asset('images/'.$banner->banner_image) }}" alt=""></div>
                                @endforeach
                            </div>
<<<<<<< HEAD

=======

>>>>>>> 43a80e1e974b21e2159a82ea6b511194730c5f62
                        </div>
                    </div>
                </div>
            </div>
            <!--box-widget-wrap end -->
        </div>
    </div>
</section>
<!--section end -->
<div class="limit-box fl-wrap"></div>
@endsection
@section('script')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAL6Dg0qk25EiU3vstUKfnwNOEhE-G3vAM&callback=initMap&libraries=&v=weekly" async></script>
<script>
	function initMap() {
	  	// The location of Uluru
	  	let latitude = '{{ $event->latitude }}';
	  	let longitude = '{{ $event->longitude }}';
	  	const uluru = { lat: parseFloat(latitude), lng: parseFloat(longitude) };
	  	// The map, centered at Uluru
	  	const map = new google.maps.Map(document.getElementById("singleMap"), {
	    	zoom: 12,
	    	center: uluru,
	  	});
	  	// The marker, positioned at Uluru
	  	const marker = new google.maps.Marker({
	    	position: uluru,
	    	map: map,
	  	});



	}


    var x = document.getElementById("distance");

    function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
    }

    function showPosition(position) {
    x.innerHTML = "Latitude: " + position.coords.latitude +
    "<br>Longitude: " + position.coords.longitude;
    }

function showError(error) {
  switch(error.code) {
    case error.PERMISSION_DENIED:
      x.innerHTML = "User denied the request for Geolocation."
      break;
    case error.POSITION_UNAVAILABLE:
      x.innerHTML = "Location information is unavailable."
      break;
    case error.TIMEOUT:
      x.innerHTML = "The request to get user location timed out."
      break;
    case error.UNKNOWN_ERROR:
      x.innerHTML = "An unknown error occurred."
      break;
  }
}
</script>
@endsection
