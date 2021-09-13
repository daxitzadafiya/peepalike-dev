@extends('eventfrontend.layout.app')

@section('content')
<div class="wrapper"> <!--========== full content wrapper start ==========-->
       <header class="header event_header"> <!--========== header start ==========-->
            <div class="event_header_text"> <!--========== event header text start ==========-->
                <div class="event_header_text_content_wrapper">
                    <div class="event_header_text_content">
                        <h4>ARCHIVES : EVENTS</h4>
                        <h5><span>Home</span><i class="fas fa-angle-right"></i><span>Event</span></h5>
                    </div>
                </div>
            </div> <!--========== event header text end ==========-->
            <div class="container-fluid header_main_content">
                @include("eventfrontend.layout.includes.layout-sidenav")
            </div>
        </header> <!--========== header end ==========-->
        <main class="main_content"> <!--========== main contents start ==========-->
            <section class="event_search_form"> <!--========== event search form start ==========-->
                <div class="container">
                    <div class="event_search_form_wrapper">
                        <div class="event_search_form_content">
                            <form action="">
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="event_form_input">
                                            <input type="text" placeholder="Enter name..">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="event_form_input">
                                            <input id="select_ctg" list="select" name="select" placeholder="All Categories ..">
                                            <datalist class="select_data_list" id="select">
                                                <option value="value"></option>
                                                <option value="Fund"></option>
                                                <option value="Insta"></option>
                                            </datalist>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="event_form_input">
                                            <input id="select_ctg" list="select" name="select" placeholder="All States ..">
                                            <datalist class="select_data_list" id="select">
                                                <option value="value"></option>
                                                <option value="Fund"></option>
                                                <option value="Insta"></option>
                                            </datalist>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="event_form_input">
                                            <input id="select_ctg" list="select" name="select" placeholder="All Cities ..">
                                            <datalist class="select_data_list" id="select">
                                                <option value="value"></option>
                                                <option value="Fund"></option>
                                                <option value="Insta"></option>
                                            </datalist>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row_margin_top">
                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="event_form_input">
                                            <input id="select_ctg" list="select" name="select" placeholder="All Time">
                                            <datalist class="select_data_list" id="select">
                                                <option value="value"></option>
                                                <option value="Fund"></option>
                                                <option value="Insta"></option>
                                            </datalist>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="event_form_input">
                                            <input placeholder="Start date..." class="textbox-n" type="text" onfocus="(this.type='date')" id="date">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="event_form_input">
                                            <input placeholder="End date..." class="textbox-n" type="text" onfocus="(this.type='date')" id="date">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="event_form_input">
                                            <input type="text" placeholder="Value...">
                                        </div>
                                    </div>
                                </div>
                                <div class="row row_margin_top">
                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="event_form_input">
                                            <input id="select_ctg" list="select" name="select" placeholder="Select Price">
                                            <datalist class="select_data_list" id="select">
                                                <option value="value"></option>
                                                <option value="Fund"></option>
                                                <option value="Insta"></option>
                                            </datalist>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="event_form_input">
                                            <input id="select_ctg" list="select" name="select" placeholder="Select Job">
                                            <datalist class="select_data_list" id="select">
                                                <option value="value"></option>
                                                <option value="Fund"></option>
                                                <option value="Insta"></option>
                                            </datalist>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="event_form_input">
                                            <input id="select_ctg" list="select" name="select" placeholder="Select Time">
                                            <datalist class="select_data_list" id="select">
                                                <option value="value"></option>
                                                <option value="Fund"></option>
                                                <option value="Insta"></option>
                                            </datalist>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="event_form_input">
                                            <input id="select_ctg" list="select" name="select" placeholder="Select Space">
                                            <datalist class="select_data_list" id="select">
                                                <option value="value"></option>
                                                <option value="Fund"></option>
                                                <option value="Insta"></option>
                                            </datalist>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row_margin_top">
                                    <div class="col-12">
                                        <div class="event_search_btn">
                                            <button>search</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section> <!--========== event search form end ==========-->
            <section class="event_upconeing"> <!--========== upcomeing section start ==========-->
                <div class="container">
                    <div class="row">
                        @foreach($events as $event)
                        <div class="col-12 col-sm-12 col-md-6 col-lg-4 colume_padding">
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
                        @endforeach
                    </div>
                </div>
            </section> <!--========== upcomeing section end ==========-->
        </main> <!--========== main content end ==========-->

        @include("eventfrontend.layout.includes.layout-footer")
    </div> <!--========== full content wrapper end ==========-->
@endsection
