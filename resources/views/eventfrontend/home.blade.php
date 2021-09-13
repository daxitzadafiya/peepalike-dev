@extends('eventfrontend.layout.app')
@section('content')
<div class="wrapper"> <!--========== full content wrapper start ==========-->
        <header class="header"> <!--========== header start ==========-->
            <div class="header_slider"> <!--========== header slider start ==========-->
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('frontendassets/images/pexels-charles-parker-5847375.jpg') }}" class="d-block w-100" alt="img">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('frontendassets/images/pexels-alex-powell-1769409.jpg') }}" class="d-block w-100" alt="img">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('frontendassets/images/Chittagong-Bangladesh.png') }}" class="d-block w-100" alt="img">
                        </div>
                    </div>
                </div>
            </div> <!--========== header slider end ==========-->
            <div class="container-fluid header_main_content"> 
                @include("eventfrontend.layout.includes.layout-sidenav")
                <div class="header_heading_text_form"> <!--========== header heading text search form start ==========-->
                    <div class="header_heading_text">
                        <div>
                            <h4>Connecting the world</h4>
                            <p>Easy to search, you just enter the keyword</p>
                        </div>
                    </div>
                    <div class="header_heading_search_form">
                        <div class="header_heading_search_form_content">
                            <form action="">
                                <div class="entar_name_div">
                                    <label for="en_name"><i class="fas fa-search"></i></label>
                                    <input id="en_name" type="text" placeholder="Enter name...">
                                </div>
                                <div class="entar_catag_div">
                                    <label for="select_ctg"><i class="far fa-file-alt"></i></label>
                                    <input id="select_ctg" list="select" name="select" placeholder="All categories ..">
                                    <datalist class="select_data_list" id="select">
                                        <option value="value"></option>
                                        <option value="Fund"></option>
                                        <option value="Insta"></option>
                                    </datalist>
                                </div>
                                <div class="entar_place_div">
                                    <label for="en_city"><i class="fas fa-map-marker-alt"></i></label>
                                <input id="en_city" type="text" placeholder="State city ...">
                                </div>
                                <div class="search_btn_div">
                                    <button>search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="text_crasol"> <!--========== text crasol start ==========-->
                        <div class="text_crasol_content">
                            <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                    <h4><i class="fas fa-exclamation-circle"></i> ki hobina na holeo bol</h4>
                                </div>
                                <div class="carousel-item">
                                    <h4><i class="fas fa-exclamation-circle"></i> ki hobina na holeo bol</h4>
                                </div>
                                <div class="carousel-item">
                                    <h4><i class="fas fa-exclamation-circle"></i> ki hobina na holeo bol</h4>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div> <!--========== text crasol end ==========-->
                </div> <!--========== header heading text search form end ==========-->
            </div> 
        </header> <!--========== header end ==========-->
        <main class="main_content"> <!--========== main content start ==========-->
            <section class="catd_offers_section"> <!--========== card offer section start ==========-->
                <div class="container">
                    <div class="row">
                        @foreach($categories as $category)
                        <div class="col-12 col-sm-4 col-md-2 card_offer_col_padding">
                            <div class="card_offer_content_wrapp">
                                <a href="#">
                                    <div class="card_offer_content">
                                        <li>
                                            <!--<i class="fas fa-file-invoice-dollar"></i>-->
                                            <img src="{{ $category->icon }}" alt="" style="height: 50px;">
                                        </li>
                                        <h5>{{ $category->category_name }}</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section> <!--========== catd offer section end ==========-->
            <section class="upcomeing_evert_section"> <!--========== upcomeing section start ==========-->
                <div class="container">
                    <div class="upcomeing_heading">
                        <div class="row">
                            <div class="col-12">
                                <div class="section_heading_content">
                                    <h3>Upcoming Events</h3>
                                    <p>You can choose to display featured</p>
                                    <p id="my_long" style="display:none"></p>
                                    <p id="my_lat" style="display:none"></p>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product_item margin_top">
                        <div class="row">
                            <div class="owl-carousel second_owl-carousel owl-theme">
                                @foreach($events as $event)
                                <div class="item">
                                    <div class="row">
                                        <div class="upcoming_all_content">
                                            <div class="upcoming_event_wrapper">
                                                <div class="upcoeming_event_img_wrapper">
                                                    <a href="#">
                                                        <img src="{{ asset('images/'.$event->event_image) }}" alt="event">
                                                        <!--<li class="li_heart_icon"><i class="far fa-heart"></i></li>-->
                                                        <!-- <li class="person_img"><img src="{{ asset('frontendassets/images/3939920bf4783ac774bb2c4811ce5d0c2582d665-tc-img-preview.jpg') }}" alt="img"></li>
                                                        <li class="perdon_img_pairs_li perdon_img_pairs_li_1" title="jone dou">
                                                            <div class="persone_img_pairs">
                                                                <img src="{{ asset('frontendassets/images/pexels-photo-1043474.jpeg') }}" alt="img">
                                                            </div>
                                                        </li>
                                                        <li class="perdon_img_pairs_li perdon_img_pairs_li_2" title="nil daue">
                                                            <div class="persone_img_pairs">
                                                                <img src="{{ asset('frontendassets/images/pexels-photo-2853534.jpeg') }}" alt="img">
                                                            </div>
                                                        </li>
                                                        <li class="perdon_img_pairs_li perdon_img_pairs_li_3" title="amy fari">
                                                            <div class="persone_img_pairs">
                                                                <img src="{{ asset('frontendassets/images/pexels-photo-4048497.jpeg') }}" alt="img">
                                                            </div>
                                                        </li>
                                                        <li class="perdon_img_pairs_li perdon_img_pairs_li_4" title="mack jaci">
                                                            <div class="persone_img_pairs">
                                                                <img src="{{ asset('frontendassets/images/pexels-photo-2379004.jpeg') }}" alt="img">
                                                            </div>
                                                        </li> -->
                                                    </a>
                                                </div>
                                                <div class="price_btn_wrapp">
                                                    <div class="price_btn">
                                                        <button><a href="#">{{ strtoupper($event->event_type) }}</a></button>
                                                    </div>
                                                    <div class="price_num">
                                                        <h4 style="font-size:15px"><i class="far fa-calendar"></i> {{ $event->event_start_date }} | {{ $event->event_start_time }}</h4>
                                                    </div>
                                                </div>
                                                <div class="event_title_text" style="height:50px">
                                                    <h4><a href="#">
                                                        {{ $event->event_name }}
                                                    </a></h4>
                                                </div>
                                                <ul class="eventl_dure_list" style="height:100px;">
                                                    <li><i class="fas fa-map-marker-alt"></i>{{ $event->vanue_name }} | {{ $event->event_location }}</li>
                                                    <li><i class="fas fa-map-marker-alt"></i>{{ $event->address }}</li>
                                                    <li id="long_{{ $event->id }}" style="display:none">{{ $event->longitude }}</li>
                                                    <li id="lat_{{ $event->id }}" style="display:none">{{ $event->latitude }}</li>
                                                </ul>
                                                <div class="reat_btn_wrapper">
                                                    <button><a href="{{ URL::to('/event/details/'.$event->id) }}">Join</a></button>
                                                    <div class="price_btn">
                                                        <button><a style="cursor: pointer" class="get_distance" id="{{ $event->id }}">Distance to Venue</a></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section> <!--========== upcomeing section end ==========-->
            <section class="work_section"> <!--========== work section start ==========-->
                <div class="container">
                    <div class="work_heading">
                        <div class="row">
                            <div class="col-12">
                                <div class="section_heading_content">
                                    <h3>How It Work</h3>
                                    <p>You can choose to display featured</p>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="work_body_content_wrapper margin_top">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-4">
                                <div class="work_content_wrapp">
                                    <div class="work_content">
                                        <div class="work_icon">
                                            <div>
                                                <!--<i class="fas fa-globe-asia"></i>-->
                                                <img src="{{ asset('frontendassets/images/feature_1.png') }}" alt="">
                                            </div>
                                        </div>
                                        <div class="work_content_text">
                                            <h4>Choose What To Do</h4>
                                            <p>Easily find your event via search system with multiple params.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-4">
                                <div class="work_content_wrapp">
                                    <div class="work_content">
                                        <div class="work_icon">
                                            <div>
                                                <!--<i class="fas fa-globe-asia"></i>-->
                                                <img src="{{ asset('frontendassets/images/feature_2.png') }}" alt="">
                                            </div>
                                        </div>
                                        <div class="work_content_text">
                                            <h4>Choose What To Do</h4>
                                            <p>Easily find your event via search system with multiple params.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-4">
                                <div class="work_content_wrapp">
                                    <div class="work_content">
                                        <div class="work_icon">
                                            <div>
                                                <!-- <i class="fas fa-globe-asia"></i>-->
                                                <img src="{{ asset('frontendassets/images/feature_3.png') }}" alt="">
                                            </div>
                                        </div>
                                        <div class="work_content_text">
                                            <h4>Choose What To Do</h4>
                                            <p>Easily find your event via search system with multiple params.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> <!--========== work section end ==========-->
            <section class="visited_places_section"> <!--========== visited places section start ==========-->
                <div class="container">
                    <div class="visited_places_heading">
                        <div class="row">
                            <div class="col-12">
                                <div class="section_heading_content">
                                    <h3>Most Visited Places</h3>
                                    <p>You can choose to display feature</p>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="visited_places_body_content_wrapper margin_top">
                        <div class="row">
                            <div class="owl-carousel four_owl-carousel owl-theme">
                                <div class="item">
                                    <div class="product_content">
                                        <div class="product_img four_product_img">
                                            <a href="#">
                                                <img src="{{ asset('frontendassets/images/pexels-photo-3182530.jpeg') }}" alt="product">
                                                <h4>tahoe city <br><span class="ev_tx">0 event</span></h4>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="product_content">
                                        <div class="product_img four_product_img">
                                            <a href="#">
                                                <img src="{{ asset('frontendassets/images/pexels-photo-5357985.jpeg') }}" alt="product">
                                                <h4>tahoe city<br><span class="ev_tx">0 event</span></h4>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="product_content">
                                        <div class="product_img four_product_img">
                                            <a href="#">
                                                <img src="{{ asset('frontendassets/images/pexels-photo-6062024.jpeg') }}" alt="product">
                                                <h4>tahoe city<br><span class="ev_tx">0 event</span></h4>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="product_content">
                                        <div class="product_img four_product_img">
                                            <a href="#">
                                                <img src="{{ asset('frontendassets/images/pexels-photo-4846221.jpeg') }}" alt="product">
                                                <h4>tahoe city<br><span class="ev_tx">0 event</span></h4>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="product_content">
                                        <div class="product_img four_product_img">
                                            <a href="#">
                                                <img src="{{ asset('frontendassets/images/pexels-photo-6058327.jpeg') }}" alt="product">
                                                <h4>tahoe city<br><span class="ev_tx">0 event</span></h4>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="product_content">
                                        <div class="product_img four_product_img">
                                            <a href="#">
                                                <img src="{{ asset('frontendassets/images/pexels-photo-1981526.jpeg') }}" alt="product">
                                                <h4>tahoe city<br><span class="ev_tx">0 event</span></h4>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="product_content">
                                        <div class="product_img four_product_img">
                                            <a href="#">
                                                <img src="{{ asset('frontendassets/images/pexels-photo-1780838.jpeg') }}" alt="product">
                                                <h4>tahoe city<br><span class="ev_tx">0 event</span></h4>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="product_content">
                                        <div class="product_img four_product_img">
                                            <a href="#">
                                                <img src="{{ asset('frontendassets/images/pexels-photo-440305.jpeg') }}" alt="product">
                                                <h4>tahoe city<br><span class="ev_tx">0 event</span></h4>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> <!--========== visited places section end ==========-->
            <section class="latest_news_section"> <!--========== latest news section start ==========-->
                <div class="container">
                    <div class="latest_news_heading">
                        <div class="row">
                            <div class="col-12">
                                <div class="section_heading_content">
                                    <h3>Our Latest News</h3>
                                    <p>News From Our Bloge</p>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="latest_news_body_content_wrapper margin_top">
                        <div class="row">
                            <div class="owl-carousel third_owl-carousel owl-theme">
                                <div class="item">
                                    <div class="singal_latest_news">
                                        <div class="latest_news_content_wrapper">
                                            <div class="latest_news_img">
                                                <img src="{{ asset('frontendassets/images/lates1.jpg') }}" alt="news">
                                            </div>
                                            <div class="latest_news_text_content">
                                                <h4><span><a href="#"><i class="fas fa-graduation-cap"></i>education</a></span>&#124;<span><i class="far fa-clock"></i>june 25, 2021</span></h4>
                                                <h3><a href="#">Lorem ipsum dolor sit amet.</a></h3>
                                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eveniet voluptates modi ipsam.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="singal_latest_news">
                                        <div class="latest_news_content_wrapper">
                                            <div class="latest_news_img">
                                                <img src="{{ asset('frontendassets/images/lates2.jpg') }}" alt="news">
                                            </div>
                                            <div class="latest_news_text_content">
                                                <h4><span><a href="#"><i class="fas fa-graduation-cap"></i>education</a></span>&#124;<span><i class="far fa-clock"></i>june 25, 2021</span></h4>
                                                <h3><a href="#">Lorem ipsum dolor sit amet.</a></h3>
                                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eveniet voluptates modi ipsam.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="singal_latest_news">
                                        <div class="latest_news_content_wrapper">
                                            <div class="latest_news_img">
                                                <img src="{{ asset('frontendassets/images/lates3.jpg') }}" alt="news">
                                            </div>
                                            <div class="latest_news_text_content">
                                                <h4><span><a href="#"><i class="fas fa-graduation-cap"></i>education</a></span>&#124;<span><i class="far fa-clock"></i>june 25, 2021</span></h4>
                                                <h3><a href="#">Lorem ipsum dolor sit amet.</a></h3>
                                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eveniet voluptates modi ipsam.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="singal_latest_news">
                                        <div class="latest_news_content_wrapper">
                                            <div class="latest_news_img">
                                                <img src="{{ asset('frontendassets/images/lates2.jpg') }}" alt="news">
                                            </div>
                                            <div class="latest_news_text_content">
                                                <h4><span><a href="#"><i class="fas fa-graduation-cap"></i>education</a></span>&#124;<span><i class="far fa-clock"></i>june 25, 2021</span></h4>
                                                <h3><a href="#">Lorem ipsum dolor sit amet.</a></h3>
                                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eveniet voluptates modi ipsam.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="singal_latest_news">
                                        <div class="latest_news_content_wrapper">
                                            <div class="latest_news_img">
                                                <img src="{{ asset('frontendassets/images/lates4.jpg') }}" alt="news">
                                            </div>
                                            <div class="latest_news_text_content">
                                                <h4><span><a href="#"><i class="fas fa-graduation-cap"></i>education</a></span>&#124;<span><i class="far fa-clock"></i>june 25, 2021</span></h4>
                                                <h3><a href="#">Lorem ipsum dolor sit amet.</a></h3>
                                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eveniet voluptates modi ipsam.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="singal_latest_news">
                                        <div class="latest_news_content_wrapper">
                                            <div class="latest_news_img">
                                                <img src="{{ asset('frontendassets/images/lates1.jpg') }}" alt="news">
                                            </div>
                                            <div class="latest_news_text_content">
                                                <h4><span><a href="#"><i class="fas fa-graduation-cap"></i>education</a></span>&#124;<span><i class="far fa-clock"></i>june 25, 2021</span></h4>
                                                <h3><a href="#">Lorem ipsum dolor sit amet.</a></h3>
                                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eveniet voluptates modi ipsam.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="singal_latest_news">
                                        <div class="latest_news_content_wrapper">
                                            <div class="latest_news_img">
                                                <img src="{{ asset('frontendassets/images/lates3.jpg') }}" alt="news">
                                            </div>
                                            <div class="latest_news_text_content">
                                                <h4><span><a href="#"><i class="fas fa-graduation-cap"></i>education</a></span>&#124;<span><i class="far fa-clock"></i>june 25, 2021</span></h4>
                                                <h3><a href="#">Lorem ipsum dolor sit amet.</a></h3>
                                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eveniet voluptates modi ipsam.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="singal_latest_news">
                                        <div class="latest_news_content_wrapper">
                                            <div class="latest_news_img">
                                                <img src="{{ asset('frontendassets/images/lates4.jpg') }}" alt="news">
                                            </div>
                                            <div class="latest_news_text_content">
                                                <h4><span><a href="#"><i class="fas fa-graduation-cap"></i>education</a></span>&#124;<span><i class="far fa-clock"></i>june 25, 2021</span></h4>
                                                <h3><a href="#">Lorem ipsum dolor sit amet.</a></h3>
                                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eveniet voluptates modi ipsam.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> <!--========== latest news section end ==========-->
            <section class="subscription_section"> <!--========== subscription section start ==========-->
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-5">
                            <div class="surscribe_text">
                                <h4>SUBSCRIBE</h4>
                                <h3>Sign up for Newsletter!</h3>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-7">
                            <div class="subsvribe_form">
                                <form action="">
                                    <input type="text" placeholder="Entar your email">
                                    <button>SUBSCRIBE<i class="fas fa-arrow-right"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section> <!--========== subscription section end ==========-->
        </main> <!--========== main content end ==========-->
        @include("eventfrontend.layout.includes.layout-footer")
    </div> <!--========== full content wrapper end ==========-->
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    function getLong() {
        if(navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                document.getElementById('my_long').innerHTML = position.coords.longitude;
            });
        }
    }
    function getLat() {
        if(navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                document.getElementById('my_lat').innerHTML = position.coords.latitude;
            });
        }
    }
    function calcDistance(lat1, lon1, lat2, lon2) 
    {
      var R = 6371; // km
      var dLat = toRad(lat2-lat1);
      var dLon = toRad(lon2-lon1);
      var lat1 = toRad(lat1);
      var lat2 = toRad(lat2);

      var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
        Math.sin(dLon/2) * Math.sin(dLon/2) * Math.cos(lat1) * Math.cos(lat2); 
      var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
      var d = R * c;
      return d;
    }

    // Converts numeric degrees to radians
    function toRad(Value) 
    {
        return Value * Math.PI / 180;
    }
    $(function(){
        getLat();
        getLong()
        $(document).on('click', '.get_distance' ,function(){
            let event = $(this).attr('id');
            let event_lat = parseFloat($("#lat_"+event).text());
            let event_long = parseFloat($("#long_"+event).text());
            let user_lat = parseFloat($("#my_lat").text());
            let user_long = parseFloat($("#my_long").text());
            let total_dist = calcDistance(event_lat, event_long, user_lat, user_long).toFixed(2) + "KM Away";
            $(this).text(total_dist);
        });
    });
</script>
@endsection
