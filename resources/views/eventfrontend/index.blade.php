@extends('eventfrontend.layout.newtheme-layout')
@section('title', 'Home')
@section('content')
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
<!--section -->
<section class="hero-section no-dadding home-blog-wrapper home-page-wrapper"  id="sec1">
    <div class="slider-container-wrap fl-wrap">
        <div class="slider-container">
            <!-- slideshow-item -->
            <div class="slider-item fl-wrap">
                <div class="bg"  data-bg="{{ asset('newtheme/images/sliderimage1.jpg') }}"></div>
                <div class="overlay"></div>
                <div class="hero-section-wrap fl-wrap">
                    <div class="container">
                        <div class="intro-item fl-wrap">
                            <h2>Discover Events Happening in Your City</h2>
                            <h3>200M+ Events | 30,000 Cities | 4M People Exploring Events every month</h3>
                        </div>
                        <div class="main-search-input-wrap">
                            <div class="main-search-input fl-wrap">
                                <div class="main-search-input-item">
                                    <input type="text" placeholder="What are you looking for?" value=""/>
                                </div>
                                <div class="main-search-input-item location">
                                  <input type="text" placeholder="Location" id="city" value="{{ $city }}"/>
                                    <a href="#" id="location"><i class="fa fa-dot-circle-o" id="city"></i></a>
                                </div>
                                <div class="main-search-input-item">
                                    <select placeholder="All Categories" class="chosen-select" >
                                        <option>All Categories</option>
                                        @foreach($categories as $category)
                                        <option>{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button class="main-search-button">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  slideshow-item end  -->
            <!-- slideshow-item -->
            <div class="slider-item fl-wrap">
                <div class="bg"  data-bg="{{ asset('newtheme/images/sliderimage2.jpg') }}"></div>
                <div class="overlay"></div>
                <div class="hero-section-wrap fl-wrap">
                    <div class="container">
                        <div class="intro-item fl-wrap">
                            <h2>Discover Events Happening in Your City</h2>
                            <h3>200M+ Events | 30,000 Cities | 4M People Exploring Events every month</h3>
                        </div>
                        <div class="main-search-input-wrap">
                            <div class="main-search-input fl-wrap">
                                <div class="main-search-input-item">
                                    <input type="text" placeholder="What are you looking for?" value=""/>
                                </div>
                                <div class="main-search-input-item location">
                                    <input type="text" placeholder="Location" value=""/>
                                    <a href="#" id=""><i class="fa fa-dot-circle-o"></i></a>
                                </div>
                                <div class="main-search-input-item">
                                    <select data-placeholder="All Categories" class="chosen-select" >
                                        <option>All Categories</option>
                                        @foreach($categories as $category)
                                        <option>{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button class="main-search-button">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  slideshow-item end  -->
            <!-- slideshow-item -->
            <div class="slider-item fl-wrap">
                <div class="bg"  data-bg="{{ asset('newtheme/images/sliderimage3.jpg') }}"></div>
                <div class="overlay"></div>
                <div class="hero-section-wrap fl-wrap">
                    <div class="container">
                        <div class="intro-item fl-wrap">
                            <h2>Discover Events Happening in Your City</h2>
                            <h3>200M+ Events | 30,000 Cities | 4M People Exploring Events every month</h3>
                        </div>
                        <div class="main-search-input-wrap">
                            <div class="main-search-input fl-wrap">
                                <div class="main-search-input-item">
                                    <input type="text" placeholder="What are you looking for?" value=""/>
                                </div>
                                <div class="main-search-input-item location">
                                    <input type="text" placeholder="Location" value=""/>
                                    <a href="#"><i class="fa fa-dot-circle-o"></i></a>
                                </div>
                                <div class="main-search-input-item">
                                    <select data-placeholder="All Categories" class="chosen-select" >
                                        <option>All Categories</option>
                                        @foreach($categories as $category)
                                        <option>{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button class="main-search-button">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  slideshow-item end  -->
        </div>
        <div class="swiper-button-prev sw-btn"><i class="fa fa-long-arrow-left"></i></div>
        <div class="swiper-button-next sw-btn"><i class="fa fa-long-arrow-right"></i></div>
    </div>
</section>
<!-- section end -->
<!-- <section>
    <div class="container">
        <div class="section-title">
            <h2>Popular Categories</h2>
            <div class="section-subtitle">Discover More </div>
            <span class="section-separator"></span>
        </div>
        <div class="process-wrap-category fl-wrap">
            <ul>
                @foreach($categories as $category)
                <li>
                    <div class="process-item">
                        <div>
                            <img src="{{ $category->icon }}" alt="" style="height: 50px;">
                        </div>
                        <h4>{{ $category->category_name }}</h4>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</section> -->
<section class="gray-section category-icon-listing">
    {{-- <div class="container">
        <div class="section-title">
            <h2>Trending Events</h2>
            <div class="section-subtitle">Discover More </div>
            <span class="section-separator"></span>
        </div>
    </div> --}}
    <!-- carousel -->
    <div class="list-carousel fl-wrap card-listing ">
        <!--listing-carousel-->
        <div class="listing-carousel fl-wrap category-carousel">
            @foreach($categories as $category)
            <div class="slick-slide-item">
                <div class="listing-item">
                    <article class="geodir-category-listing fl-wrap">
                        <a href="#">
                            <div class="geodir-category-img">
                                <img src="{{ $category->icon }}" alt="" style="height: 50px;padding: 0px 40%;margin-top: 15px;">
                                <div class="overlay"></div>
                            </div>
                        </a>
                        <div class="geodir-category-content fl-wrap">
                            {{ $category->category_name }}
                        </div>
                    </article>
                </div>
            </div>
            @endforeach
        </div>
        <!--listing-carousel end-->
        {{-- <div class="swiper-button-prev sw-btn"><i class="fa fa-long-arrow-left"></i></div>
        <div class="swiper-button-next sw-btn"><i class="fa fa-long-arrow-right"></i></div> --}}
    </div>
    <!--  carousel end-->
</section>
<section class="tranding-events-wrapper">
    <div class="container">
        <div class="section-title">
            <h2>Trending Events</h2>
            <div class="section-subtitle">Discover More </div>
            <span class="section-separator"></span>
        </div>
    </div>
    <!-- carousel -->
    <div class="list-carousel fl-wrap card-listing">
        <!--listing-carousel-->
        <div class="listing-carousel fl-wrap" id="trending-items-carousel">
            @foreach($trendingEvents as $trendEvent)
            <!--slick-slide-item-->
            <div class="slick-slide-item">
                <!-- listing-item -->
                <div class="listing-item">
                    <article class="geodir-category-listing fl-wrap">
                        <a href="{{ URL::to('/event/details/'.$trendEvent->id) }}">
                            <div class="geodir-category-img">
                                <img src="{{ asset('images/'.$trendEvent->event_image) }}" alt="" style="height: 200px;">
                                <div class="overlay"></div>
                            </div>
                        </a>
                        <div class="geodir-category-content fl-wrap">
                            <a class="listing-geodir-category" href="{{ URL::to('/event/details/'.$trendEvent->id) }}">{{ strtoupper($trendEvent->event_type) }}</a>
                            <h3><a href="{{ URL::to('/event/details/'.$trendEvent->id) }}">{{ $trendEvent->event_name }}</a></h3>
                            <p>{{ $trendEvent->vanue_name }} | {{ $trendEvent->event_location }}</p>
                            <p><i class="fa fa-location-arrow"></i> <span style="cursor:pointer" class="get_distance" id="{{ $trendEvent->id }}">Calculate Distance to Venue</span></p>
                            <p id="long_{{ $trendEvent->id }}" style="display:none">{{ $trendEvent->longitude }}</p>
                            <p id="lat_{{ $trendEvent->id }}" style="display:none">{{ $trendEvent->latitude }}</p>
                            <div class="geodir-category-location"><a href="{{ URL::to('/event/details/'.$trendEvent->id) }}"><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $trendEvent->address }}</a></div>
                            <div class="geodir-category-options fl-wrap">
                                <p><i class="fa fa-calendar-check-o"></i> <span>{{ $trendEvent->event_start_date }} | {{ $trendEvent->event_start_time }}</span></p>
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
<!--section -->
<section class="gray-section upcoming-events">
    <div class="container">
        <div class="section-title">
            <h2>Upcoming Events</h2>
            <div class="section-subtitle">Best Events</div>
            <p id="my_long" style="display:none"></p>
            <p id="my_lat" style="display:none"></p>
            <span class="section-separator"></span>
        </div>
    </div>
    <!-- carousel -->
    <div class="list-carousel fl-wrap card-listing ">
        <!--listing-carousel-->
        <div class="listing-carousel fl-wrap upcoming-events-carousel">
            @foreach($events as $event)
            <!--slick-slide-item-->
            <div class="slick-slide-item">
                <!-- listing-item -->
                <div class="listing-item">
                    <article class="geodir-category-listing fl-wrap">
                        <a href="{{ URL::to('/event/details/'.$event->id) }}">
                            <div class="geodir-category-img">
                                <img src="{{ asset('images/'.$event->event_image) }}" alt="" style="height: 200px;">
                                <div class="overlay"></div>
                            </div>
                        </a>
                        <div class="geodir-category-content fl-wrap">
                            <a class="listing-geodir-category" href="{{ URL::to('/event/details/'.$event->id) }}">{{ strtoupper($event->event_type) }}</a>
                            <h3><a href="{{ URL::to('/event/details/'.$event->id) }}">{{ $event->event_name }}</a></h3>
                            <p>{{ $event->vanue_name }} | {{ $event->event_location }}</p>
                            <p><i class="fa fa-calendar-check-o"></i> <span>{{ $event->event_start_date }} | {{ $event->event_start_time }}</span></p>
                            <p><i class="fa fa-location-arrow"></i> <span style="cursor:pointer" class="get_distance" id="{{ $event->id }}">Calculate Distance to Venue</span></p>
                            <p id="long_{{ $event->id }}" style="display:none">{{ $event->longitude }}</p>
                            <p id="lat_{{ $event->id }}" style="display:none">{{ $event->latitude }}</p>
                            <div class="geodir-category-options fl-wrap">
                                <div class="geodir-category-location"><a href="{{ URL::to('/event/details/'.$event->id) }}"><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $event->address }}</a></div>
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
<!-- section end -->
<!--section -->
<!-- <section>
    <div class="container">
        <div class="section-title">
            <h2>How it Works</h2>
            <div class="section-subtitle">Discover & Connect </div>
            <span class="section-separator"></span>
        </div>
        <div class="process-wrap fl-wrap">
            <ul>
                <li>
                    <div class="process-item">
                        <span class="process-count">01 . </span>
                        <div class="time-line-icon">
                            <img src="{{ asset('newtheme/images/features/feature_1.png') }}" />
                        </div>
                        <h4>Choose What to do</h4>
                        <p>Easily find your event via search system with multiple params</p>
                    </div>
                    <span class="pr-dec"></span>
                </li>
                <li>
                    <div class="process-item">
                        <span class="process-count">02 .</span>
                        <div class="time-line-icon">
                            <img src="{{ asset('newtheme/images/features/feature_2.png') }}" />
                        </div>
                        <h4>Choose What to do</h4>
                        <p>Easily find your event via search system with multiple params</p>
                    </div>
                    <span class="pr-dec"></span>
                </li>
                <li>
                    <div class="process-item">
                        <span class="process-count">03 .</span>
                        <div class="time-line-icon">
                            <img src="{{ asset('newtheme/images/features/feature_3.png') }}" />
                        </div>
                        <h4>Choose What to do</h4>
                        <p>Easily find your event via search system with multiple params</p>
                    </div>
                </li>
            </ul>
            <div class="process-end"><i class="fa fa-check"></i></div>
        </div>
    </div>
</section> -->
<section class="color-bg">
    <div class="shapes-bg-big"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('newtheme/images/mobile-app.png') }}" style="width: 100%;">
            </div>
            <div class="col-md-6">
                <div class="color-bg-text">
                    <h3>Stay Connected</h3>
                    <h3>Download the app</h3>
                    <a href="https://play.google.com/store/apps/details?id=com.app.peepalike&showAllReviews=true" class="color-bg-link"><i class="fa fa-play"></i> &nbsp;&nbsp;&nbsp;GOOGLE PLAY STORE</a>
                    <a href="https://apps.apple.com/ke/app/peepalike/id1560568386" class="color-bg-link"  style="margin-left:20px"><i class="fa fa-apple"></i> &nbsp;&nbsp;&nbsp;APP STORE</a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="tips-wrapper">
    <div class="container">
        <div class="section-title">
            <h2>Tips & Articles</h2>
            <div class="section-subtitle">From the blog.</div>
            <span class="section-separator"></span>
            <p>Browse the latest articles from our blog.</p>
        </div>
    </div>
    <div class="list-carousel fl-wrap card-listing">
        <!--listing-carousel-->
        <div class="listing-carousel fl-wrap multiple-items-carousel">
            @if ($BlogList)
                @foreach ($BlogList as $value)
                    <div class="slick-slide-item">
                        <!-- listing-item -->
                        <div class="listing-item">
                            <article class="card-post">
                                <div class="card-post-img fl-wrap">
                                    <a href="/blogs/details/{{$value->id}}" onclick="ViewsCount({{$value->id}})">
                                        <img src="@if($value->blog_image != '') {{ $value->blog_image }} @else {{ 'http://placehold.it/200x200' }}  @endif " alt="profile pic">
                                    </a>
                                </div>
                                <div class="card-post-content fl-wrap">
                                    <a href="/blogs/details/{{$value->id}}" onclick="ViewsCount({{$value->id}})"><h3>{{$value->blog_title}}</h3></a>
                                    <div class="blog-content">
                                        {!! Illuminate\Support\Str::limit($value->blog_content,150) !!}
                                    </div>
                                    <div class="blog_extra_detail">
                                        <div class="post-author"><a href="#"><span>By , {{$value->blog_author}}</span></a></div>
                                        <div class="post-opt">
                                            <ul>
                                                <li><i class="fa fa-calendar-check-o"></i> <span>{{date('d M Y',strtotime($value->created_at))}}</span></li>
                                                <li><i class="fa fa-eye"></i> <span>{{$value->views}}</span></li>
                                                <li><i class="fa fa-tags"></i> <a href="#">{{$value->category_type}}</a>  </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="swiper-button-prev sw-btn"><i class="fa fa-long-arrow-left"></i></div>
        <div class="swiper-button-next sw-btn"><i class="fa fa-long-arrow-right"></i></div>
    </div>
    <a href="/blogs" class="btn  big-btn circle-btn  dec-btn color-bg flat-btn">Read All<i class="fa fa-eye"></i></a>
</section>
<!-- section end -->
@endsection
@section('script')
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-203492332-1"></script>
<script type="text/javascript">
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-203492332-1');

    $(".nav-button-wrap").on("click", function () {
        $(".main-menu").toggleClass("vismobmenu");
    });
    function mobMenuInit() {
        var ww = $(window).width();
        if (ww < 1064) {
            $(".menusb").remove();
            $(".main-menu").removeClass("nav-holder");
            $(".main-menu nav").clone().addClass("menusb").appendTo(".main-menu");
            $(".menusb").menu();
        } else {
            $(".menusb").remove();
            $(".main-menu").addClass("nav-holder");
        }
    }
    mobMenuInit();
    //   css ------------------
    var $window = $(window);
    $window.on("resize", function() {
        csselem();
        mobMenuInit();
    });
</script>
<script>
    $('.category-carousel').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 2000,
        responsive: [{
                breakpoint: 2686,
                settings: {
                    slidesToShow: 5,
                }
            },{
                breakpoint: 2561,
                settings: {
                    slidesToShow: 5,
                }
            },{
                breakpoint: 1880,
                settings: {
                    slidesToShow: 4,
                }
            },{
                breakpoint: 1500,
                settings: {
                    slidesToShow: 4,
                }
            },
            {
                breakpoint: 1224,
                settings: {
                    slidesToShow: 3,
                }
            },

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

    $('.multiple-items-carousel').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: true,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 2000,
        centerMode: true,
        centerPadding: '0',
        responsive: [{
                breakpoint: 2686,
                settings: {
                    slidesToShow: 5,
                }
            },{
                breakpoint: 2561,
                settings: {
                    slidesToShow: 4,
                }
            },{
                breakpoint: 1880,
                settings: {
                    slidesToShow: 4,
                }
            },{
                breakpoint: 1500,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 1224,
                settings: {
                    slidesToShow: 3,
                }
            },

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
    });

    $('#trending-items-carousel').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: true,
        arrows: false,
        centerMode: true,
        centerPadding: '0',
        responsive: [{
                breakpoint: 2686,
                settings: {
                    slidesToShow: 5,
                }
            },{
                breakpoint: 2561,
                settings: {
                    slidesToShow: 4,
                }
            },{
                breakpoint: 1880,
                settings: {
                    slidesToShow: 4,
                }
            },{
                breakpoint: 1590,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 1224,
                settings: {
                    slidesToShow: 2,
                }
            },

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
    $('.upcoming-events-carousel').slick({
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 1,
        dots: true,
        arrows: false,
        centerMode: true,
        centerPadding: '0',
        responsive: [{
                breakpoint: 2561,
                settings: {
                    slidesToShow: 5,
                }
            },{
                breakpoint: 1880,
                settings: {
                    slidesToShow: 5,
                }
            },{
                breakpoint: 1500,
                settings: {
                    slidesToShow: 4,
                }
            },
            {
                breakpoint: 1224,
                settings: {
                    slidesToShow: 3,
                }
            },

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

    function ViewsCount(data) {
        var id = data;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type : 'POST',
            url  : '/blogs/views/' + id,
            data : {},
            success : function(res) {

            } 
        })   
    }

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