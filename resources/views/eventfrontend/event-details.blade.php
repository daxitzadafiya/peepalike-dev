@extends('eventfrontend.layout.newtheme-layout')
@section('title', 'Event Details')
@section('content')
<style type="text/css">

    body{
        margin-top:20px;
        background:#f3f3f3;
    }
    
    .card.user-card {
        border-top: none;
        -webkit-box-shadow: 0 0 1px 2px rgba(0,0,0,0.05), 0 -2px 1px -2px rgba(0,0,0,0.04), 0 0 0 -1px rgba(0,0,0,0.05);
        box-shadow: 0 0 1px 2px rgba(0,0,0,0.05), 0 -2px 1px -2px rgba(0,0,0,0.04), 0 0 0 -1px rgba(0,0,0,0.05);
        -webkit-transition: all 150ms linear;
        transition: all 150ms linear;
    }
    
    .card {
        border-radius: 5px;
        -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
        box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
        border: none;
        margin-bottom: 30px;
        -webkit-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
    }
    
    .card .card-header {
        background-color: transparent;
        border-bottom: none;
        padding: 25px;
    }
    
    .card .card-header h5 {
        margin-bottom: 0;
        color: #222;
        font-size: 14px;
        font-weight: 600;
        display: inline-block;
        margin-right: 10px;
        line-height: 1.4;
    }
    
    .card .card-header+.card-block, .card .card-header+.card-block-big {
        padding-top: 0;
    }
    
    .user-card .card-block {
        text-align: center;
    }
    
    .card .card-block {
        padding: 25px;
    }
    
    .user-card .card-block .user-image {
        position: relative;
        margin: 0 auto;
        display: inline-block;
        padding: 5px;
        width: 110px;
        height: 110px;
    }
    
    .user-card .card-block .user-image img {
        z-index: 20;
        position: absolute;
        top: 5px;
        left: 5px;
            width: 100px;
        height: 100px;
    }
    
    .img-radius {
        border-radius: 50%;
    }
    
    .f-w-600 {
        font-weight: 600;
    }
    
    .m-b-10 {
        margin-bottom: 10px;
    }
    
    .m-t-25 {
        margin-top: 25px;
    }
    
    .m-t-15 {
        margin-top: 15px;
    }
    
    .card .card-block p {
        line-height: 1.4;
    }
    
    .text-muted {
        color: #919aa3!important;
    }
    
    .user-card .card-block .activity-leval li.active {
        background-color: #2ed8b6;
    }
    
    .user-card .card-block .activity-leval li {
        display: inline-block;
        width: 15%;
        height: 4px;
        margin: 0 3px;
        background-color: #ccc;
    }
    
    .user-card .card-block .counter-block {
        color: #fff;
    }
    
    .bg-c-blue {
        background: linear-gradient(45deg,#4099ff,#73b4ff);
    }
    
    .bg-c-green {
        background: linear-gradient(45deg,#2ed8b6,#59e0c5);
    }
    
    .bg-c-yellow {
        background: linear-gradient(45deg,#FFB64D,#ffcb80);
    }
    
    .bg-c-pink {
        background: linear-gradient(45deg,#FF5370,#ff869a);
    }
    
    .m-t-10 {
        margin-top: 10px;
    }
    
    .p-20 {
        padding: 20px;
    }
    
    .user-card .card-block .user-social-link i {
        font-size: 30px;
    }
    
    .text-facebook {
        color: #3B5997;
    }
    
    .text-twitter {
        color: #42C0FB;
    }
    
    .text-dribbble {
        color: #EC4A89;
    }
    
    .user-card .card-block .user-image:before {
        bottom: 0;
        border-bottom-left-radius: 50px;
        border-bottom-right-radius: 50px;
    }
    
    .user-card .card-block .user-image:after, .user-card .card-block .user-image:before {
        content: "";
        width: 100%;
        height: 48%;
        border: 2px solid #4099ff;
        position: absolute;
        left: 0;
        z-index: 10;
    }
    
    .user-card .card-block .user-image:after {
        top: 0;
        border-top-left-radius: 50px;
        border-top-right-radius: 50px;
    }
    
    .user-card .card-block .user-image:after, .user-card .card-block .user-image:before {
        content: "";
        width: 100%;
        height: 48%;
        border: 2px solid #4099ff;
        position: absolute;
        left: 0;
        z-index: 10;
    }
    </style>
    
<section class="gray-section" id="sec1">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="list-single-main-wrapper fl-wrap" id="sec2">
                    <!-- article> -->
                    <article>
                        <div class="list-single-main-media fl-wrap">
                            <a href="#"><img src="{{ asset('images/'.$event->event_image) }}" alt=""></a>
                        </div>
                        <div class="list-single-main-item fl-wrap">
                            <div class="list-single-main-item-title fl-wrap">
                                <h3>{{ $event->event_name }}</h3>
                            </div>
                            {{-- @if($event->event_video )
                            <iframe width="420" height="315"
                                src="{{ $event->event_video }}">
                            </iframe>
                            @endif --}}
                            <p>
                                {!! $event->description !!}

                            </p>
                            <div class="post-opt">
                                <ul>
                                    <li><i class="fa fa-calendar-check-o"></i> <b>{{ $event->event_start_date }} - {{ $event->event_end_date }} ({{ $event->event_start_time }} - {{ $event->event_end_time }})</b></li>
                                    <br>
                                    <br>
                                    <li><i class="fa fa-location-arrow"></i> <b>{{ $event->venue_name }}</b></li>
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
                        {{-- <div class="" id="distance">
                            <button onClick="getLocation()">Get</button><p id="distance">Distance</p>
                        </div> --}}
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
                        </div>
                    </div>
{{-- Organizor profile --}}
                    <div class="box-widget-item fl-wrap">
                        
                        @foreach ($organizor as  $item)
                            
                        <div class="box-widget-item-header">
                            <h3>Organizor : </h3>
                        </div>
                        <div class="box-widget widget-posts blog-widgets">
                            <div class="card user-card">
                                
                          
                                    <div class="user-image">
                                        <img src="{{ $item->image }}" class="img-radius" alt="User-Profile-Image" style="padding-top: 05px;">
                                    </div>
                                    <h6 class="f-w-600 m-t-25 m-b-10" style="font-size: 25px;">{{ $item->first_name }}</h6>
                                    <p class="text-muted" style="font-size: 15px;"> {{ $item->gender }} | {{ $item->job }}  </p>

                                    <hr>
                                    <div class="contact details">
                                        <div class="phone" style=""> 
                                            <i class="fa fa-address-book"></i>&ensp;<a href="tel:{{ $item->mobile }}">{{ $item->mobile }} </a>
                                        </div>
                                        <div class="mail"> 
                                            <i class="fa fa-envelope-square"></i> &ensp;<span>{{  $item->email }} </span>
                                        </div>

                                    </div>

                                     
                                    <div class="counter-block m-t-10 p-20" style="background-color: #23527c;;">
                                        <div class="row">
                                            
                                          <i class="fa fa-envelope" style="color: whitesmoke"></i> &ensp;<span><a href="mailto:{{ $item->email }}" style="color: whitesmoke"> Contact US </a></span>
                                         </div>
                                         
                                         <hr>
                                         <div class="col justify-content-center user-social-link">
                                             <a href="#!"><i class="fa fa-facebook text-facebook" style="color: white"></i></a> &ensp;
                                             <a href="#!"><i class="fa fa-twitter text-twitter" ></i></a> &ensp;
                                             <a href="#!"><i class="fa fa-linkedin text-linkedin" style="color: white"></i></a> &ensp;
                                             <a href="#!"><i class="fa fa-youtube text-youtube" style="color: white"></i></a>
                                         </div>
                                    </div>
                                   
                                   
                             
                            </div>
                            
                       
                        </div>
                        @endforeach


                    </div>
{{-- Similar events --}}
                    <div class="box-widget-item fl-wrap">
                        <div class="box-widget-item-header">
                            <h3>Similar Events : </h3>
                        </div>
                        <div class="box-widget widget-posts blog-widgets">
                            <div class="box-widget-content">
                                <ul>
                                    @if (count($similarEvents) > 0)
                                        @foreach ($similarEvents as $res)
                                           
                                            <li class="clearfix">
                                                <a href="/events/details/{{$res->id}}" class="widget-posts-img"><img src="{{ asset('images/'.$res->event_image) }}"  alt=""></a>
                                                <div class="widget-posts-descr">
                                                    <a href="/events/details/{{$res->id}}" title="">{{ $res->event_name}}</a>
                                                    <div class="similar-event-category">
                                                        <span title=""></span>
                                                    </div>
                                                    <span class="widget-posts-date"><i class="fa fa-calendar-check-o"></i>{{date('d M Y',strtotime($res->created_at))}} </span>

                                                </div>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
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
