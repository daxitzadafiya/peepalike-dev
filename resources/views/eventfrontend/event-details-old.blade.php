@extends('eventfrontend.layout.details-app')
@section('content')
<div class="wrapper"> <!--========== full content wrapper start ==========-->
    <header class="header entrepreneurship_header" style="background-image: url({{ asset('images/'.$event->event_image) }})"> <!--========== header start ==========-->
        <div class="container-fluid header_main_content">
            @include("eventfrontend.layout.includes.layout-sidenav")
        </div>
    </header> <!--========== header end ==========-->
    <main class="main_content"> <!--========== main content start ==========-->
	    <section class="student_conference_date_all_content"> <!--========== student conference date start ==========-->
	        <div class="container">
	            <div class="student_conference_date_content">
	                <div class="row">
	                    <div class="col-12 col-sm-12 col-md-7">
	                        <div class="student_conference_date_text_content_wrapper">
	                            <div class="student_conference_date_text">
	                                <h4>{{ $event->event_name }}</h4>
	                                <p><i class="far fa-clock"></i> {{ $event->event_start_date }} - {{ $event->event_end_date }} ({{ $event->event_start_time }} - {{ $event->event_end_time }})  </p>
	                                <p><i class="fas fa-map-marker-alt"></i>{{ $event->vanue_name }}</p>
	                                <p><i class="fas fa-map-marker-alt"></i>{{ $event->address }}</p>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="col-12 col-sm-12 col-md-5">
	                        <div class="student_conference_date_btn_wrapper">
	                            <div class="student_conference_date_btn_content">
	                                <button>Book now</button>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </section> <!--========== student conference date end ==========-->
	    <section class="discription_container"> <!--========== discription container start ==========-->
	        <div class="container">
	            <div class="row">
	                <div class="col-12 col-sm-12 col-md-8">

	                    <div class="discription_text_box"> <!--========== discription text box start ==========-->
	                        <div class="discription_text_box_head">
	                            <h4>Description</h4>
	                            <hr>
	                        </div>
	                        <div class="discription_text_box_body">
	                            <p>
	                                {{$event->description}}
	                            </p>
	                        </div>
	                    </div> <!--========== discription text box end ==========-->
	                </div>
	                <div class="col-12 col-sm-12 col-md-4 entrepeeneushipside_content_fixed_grap">   <!--========== side content start ==========-->
	                    <div class="discription_text_box"> <!--========== map start ==========-->
	                        <div class="map_heading">
	                            <div class="discription_text_box_head">
	                                <h4>map</h4>
	                                <hr>
	                            </div>
	                            <div class="map_link">
	                                <a href="#"><i class="fas fa-mouse-pointer"></i> get direction</a>
	                            </div>
	                        </div>
	                        <div class="map_body" id="map_id">
	                        </div>
	                    </div> <!--========== map end ==========-->
	                </div> <!--========== side content end ==========-->
	            </div>
	        </div>
	    </section> <!--========== discription container end ==========-->
	</main> <!--========== main content end ==========-->
    @include("eventfrontend.layout.includes.layout-footer")
</div> <!--========== full content wrapper end ==========-->
@endsection
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAL6Dg0qk25EiU3vstUKfnwNOEhE-G3vAM&callback=initMap"></script> -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAL6Dg0qk25EiU3vstUKfnwNOEhE-G3vAM&callback=initMap&libraries=&v=weekly" async></script>
<script>
	function initMap() {
	  	// The location of Uluru
	  	let latitude = '{{ $event->latitude }}';
	  	let longitude = '{{ $event->longitude }}';
	  	const uluru = { lat: parseFloat(latitude), lng: parseFloat(longitude) };
	  	// The map, centered at Uluru
	  	const map = new google.maps.Map(document.getElementById("map_id"), {
	    	zoom: 12,
	    	center: uluru,
	  	});
	  	// The marker, positioned at Uluru
	  	const marker = new google.maps.Marker({
	    	position: uluru,
	    	map: map,
	  	});
	}
</script>
