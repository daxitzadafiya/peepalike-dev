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
    <style>
        .create-event-btn:hover{
            text-decoration: none;
        }
        .tips-wrapper .blog-content{
            width: 100%;
            height: 105px;
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: 14px;
            text-align: justify;
        }
        .tips-wrapper .blog-content p{
            font-size: 14px;
            text-align: justify;
        }
        .tips-wrapper .list-single-tags a:hover{
            color:#fff !important;
        }
        .tips-wrapper .card-post-content h3{
            width: 265px;
            height: 42px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            text-align: left;
            font-size: 18px;
            font-weight: 600;
            color: #334e6f;
        }
        .tips-wrapper .card-post-content h3:hover{
            color: #53b7fe;
        }
        .tips-wrapper .card-post-img img,.tranding-events-wrapper .geodir-category-img img{
            height: 200px;
            background: no-repeat;
            object-fit: cover;
        }
        .tips-wrapper .card-post-content,.tranding-events-wrapper .geodir-category-content{
            border:1px solid #eee;
            border-top: none;
        }
        .tips-wrapper .list-carousel .sw-btn.swiper-button-prev {
            left: 22px;
        }
        .tips-wrapper .list-carousel .sw-btn.swiper-button-next {
            right: 22px;
        }
        .tips-wrapper .list-carousel {
            padding: 0 80px;
        }
        .tips-wrapper .slick-slide-item.slick-slide{
            margin-bottom: 62px;
        }
        .tips-wrapper .listing-carousel .slick-dots {
            bottom: 40px;
        }
        .home-blog-wrapper .slider-container .hero-section-wrap {
            padding: 224px;
        }
        .tips-wrapper .card-post-img img{
            -webkit-transition: all 2000ms cubic-bezier(.19,1,.22,1) 0ms;
            -webkit-transform: translateZ(0);
            transform: translateZ(0);
            transition: all 2000ms cubic-bezier(.19,1,.22,1) 0ms;
        }
        .tips-wrapper .card-post-img:hover img{
            -webkit-transform: scale(1.15);
            -moz-transform:scale(1.15);
            transform: scale(1.15);
        }
        .tranding-events-wrapper .geodir-category-options i{
            color: #4DB7FE;
            padding-right: 9px;
        }
        .tranding-events-wrapper .geodir-category-options span {
            color: #999;
            position: relative;
            font-weight: 500;
            font-size: 13px;
        }
        .tranding-events-wrapper .geodir-category-location{
            margin-top: 8px;
        }
        .tranding-events-wrapper .geodir-category-content h3,.tranding-events-wrapper .geodir-category-content p{
            width: 310px;
            height: 27px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .category-icon-listing{
            width: 1500px;
            left: 200px;
            top: -51px;
            z-index: -5000;
            background: #ffffff !important;
            margin-bottom: -144px;
            margin-top: 63px;
        }
        .category-icon-listing .geodir-category-img{
            background: #fff;
            padding: 14px 0;
        }
        .category-icon-listing .geodir-category-img img{
            background-color: #fff;
            margin-top: 0 !important;
            width: 165px !important;
            height: 35px !important;
        }
        .category-icon-listing .slick-slide-item{
            width: 243px !important;
        }
        .category-icon-listing .listing-item{
            padding: 0px 40px;
        }
        .tranding-events-wrapper .card-listing .listing-geodir-category {
            font-weight: 500;
            box-shadow: 0px 0px 0px 4px rgb(255 255 255 / 40%);
        }
        .home-page-wrapper .intro-item h3{
            font-size: 20px !important;
        }
        @media (max-width: 2561px) and (min-width: 2050px){
            .category-icon-listing{
                width: 1674px;
            }
        }
        @media (max-width: 1441px) and (min-width: 1224px){
            .category-icon-listing{
                width: 1049px;
            }
        }
        @media (max-width: 1223px) and (min-width: 1024px){
            .category-icon-listing{
                width: 900px;
                left: 67px;
            }
        }
        @media (max-width: 992px) and  (min-width: 768px){
            .home-blog-wrapper  .slider-container .hero-section-wrap {
                padding: 135px 103px;
            }
            .home-blog-wrapper .slider-container-wrap .sw-btn{
                top:32%;
            }
            .category-icon-listing{
                width: 501px;
                left: 142px;
            }
        }
        @media (max-width: 767px) and  (min-width: 432px){
            .home-blog-wrapper .slider-container .hero-section-wrap {
                padding: 104px;
            }
            .home-blog-wrapper .slider-container-wrap .sw-btn{
                top:32%;
            }
            .category-icon-listing{
                width: 300px;
                left: 71px;
            }
        }
        @media (max-width: 432px) and  (min-width: 320px){
            .home-blog-wrapper .slider-container .hero-section-wrap {
                padding: 125px 0;
            }
            .home-blog-wrapper .sw-btn{
                width: 20px;
                height: 20px;
                line-height: 20px;
            }
            .home-blog-wrapper .slider-container-wrap .sw-btn{
                top:30%;
            }
            .home-blog-wrapper.hero-section .intro-item h2 {
                font-size: 27px;
            }
            .home-blog-wrapper .sw-btn.swiper-button-prev {
                left: 22px;
            }
            .home-blog-wrapper .sw-btn.swiper-button-next {
                right: 22px;
            }
            .tranding-events-wrapper .geodir-category-content h3, .tranding-events-wrapper .geodir-category-content p {
                width: 204px;
            }
            .category-icon-listing{
                width: 355px;
                left: 34px;
            }
            .sign-in .modal-dialog {
                width: 304px;
            }
            .login-options-wrapper button {
                width: 272px;
                font-size: 12px;
            }
            .show-reg-form {
                top: 43px;
            }
            .nav-button {
                top: 48%;
                left: 64%;
                width: 15px;
                height: 20px;
            }
            .nav-button-wrap {
                height: 30px;
                width: 30px;
                top: 37px;
                margin-right: 6px;
            }
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
                            <div class="distance" style="background-color: #2f3b59; ">
                                <i class="fa fas fa-location-arrow" style="color: honeydew;"> {{ Str::limit($distance, 4) }} KM Away</i>
                            </div>
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
                    {{-- <div class="box-widget-item fl-wrap">
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
                    </div> --}}
               
                    
                </div>
            </div>
            <!--box-widget-wrap end -->
        </div>
        <section class="gray-section upcoming-events">
            <div class="container">
                <div class="section-title" style="align-items: left;text-align: left;">
                    <h2 style="text-align: left;">Similar Events</h2>
                </div>
            </div>
            <!-- carousel -->
            <div class="list-carousel fl-wrap card-listing ">
                <!--listing-carousel-->
                <div class="listing-carousel fl-wrap upcoming-events-carousel">
                    @foreach($similarEvents as $event)
                    <!--slick-slide-item-->
                    <div class="slick-slide-item" style=" height: 48rem;">
                        <!-- listing-item -->
                        <div class="listing-item">
                            <article class="geodir-category-listing fl-wrap">
                                <a href="{{ URL::to('/event/details/'.$event->id) }}">
                                    <div class="geodir-category-img">
                                        <img src="{{ asset('images/'.$event->event_image) }}" alt="" style=" width: 100%;height: 15vw; object-fit: cover;">
                                        <div class="overlay"></div>
                                    </div>
                                </a>
                                <div class="geodir-category-content fl-wrap">
                                    <a class="listing-geodir-category" href="{{ URL::to('/event/details/'.$event->id) }}">{{ strtoupper($event->event_type) }}</a>
                                    <h3><a href="{{ URL::to('/event/details/'.$event->id) }}" >{{ Str::limit($event->event_name,20) }}</a></h3>
                                    <p>{{ Str::limit($event->venue_name,20) }} | {{ Str::limit($event->event_location,20) }}</p>
                                    <p><i class="fa fa-calendar-check-o"></i> <span>{{ $event->event_start_date }} | {{ $event->event_start_time }}</span></p>
                                    {{-- <p><i class="fa fa-location-arrow"></i> <span style="cursor:pointer" class="get_distance" id="{{ $event->id }}"> {{ Str::limit(App\Http\Controllers\FrontendController::getDistance($userLat,$userLon,$event->latitude,$event->longitude), 4)  }} KM Away</span></p>
                                    <p id="long_{{ $event->id }}" style="display:none">{{ $event->longitude }}</p>
                                    <p id="lat_{{ $event->id }}" style="display:none">{{ $event->latitude }}</p> --}}
                                    <div class="geodir-category-options fl-wrap">
                                        <div class="geodir-category-location"><a href="{{ URL::to('/event/details/'.$event->id) }}"><i class="fa fa-map-marker" aria-hidden="true"></i> {{ Str::limit($event->address,20) }}</a></div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <!-- listing-item end-->
                    </div>
                    <!--slick-slide-item end-->
                    @endforeach
                </div>
                <!--listing-carousel end-->
                <div class="swiper-button-prev sw-btn"><i class="fa fa-long-arrow-left"></i></div>
                <div class="swiper-button-next sw-btn"><i class="fa fa-long-arrow-right"></i></div>
            </div>
            <!--  carousel end-->
        </section>
    <!--section end -->
    </div>
    
</section>

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


<script>

$('.upcoming-events-carousel').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        dots: true,
        arrows: false,
        centerMode: true,
        centerPadding: '0',
        responsive: [
            
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    })
    var sbp = $('.swiper-button-prev'),
		sbn = $('.swiper-button-next');
    $('.single-slider').slick({
        infinite: true,
        slidesToShow: 1,
        dots: true,
        arrows: false,
        adaptiveHeight: true
    });
    sbp.on("click", function () {
        $(this).closest(".list-carousel").find('.listing-carousel').slick('slickPrev');
    });
    sbn.on("click", function () {
        $(this).closest(".list-carousel").find('.listing-carousel').slick('slickNext');
    });
    window.addEventListener( "pageshow", function ( event ) {
        var historyTraversal = event.persisted || 
        ( typeof window.performance != "undefined" && 
            window.performance.navigation.type === 2 );
        if ( historyTraversal ) {
            // Handle page restore.
            window.location.reload();
        }
    });

</script>
@endsection
