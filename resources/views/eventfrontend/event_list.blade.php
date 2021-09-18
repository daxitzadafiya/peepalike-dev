@extends('eventfrontend.layout.newtheme-layout')
@section('title', 'Events List')
<style>
    #event-filter .nav-holder{
        float: left !important;
    }
    #event-filter .nav-holder li .btn-link{
        cursor: pointer;
    }
    #event-filter .active, .btn-link:hover{
        border-bottom: 3px solid #4DB7FE;
        color: #4DB7FE !important;
    }
    .event-listing-wrapper .geodir-category-content h3,.event-listing-wrapper .geodir-category-content p,.event-listing-wrapper .geodir-category-location{
        width: 310px;
        height: 27px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .event-listing-wrapper .geodir-category-img img{
        height: 200px;
        background: no-repeat;
        object-fit: cover;
    }
    .event-listing-wrapper .geodir-category-content{
        border:1px solid #eee;
	    border-top: none;
    }
    .event-listing-wrapper .pagination i{
        line-height: 44px;
    }
    .event-listing .listing-view-layout i{
        line-height: 40px;
    }
</style>
@section('content')
<!--  section  -->
<section class="gray-bg no-pading no-top-padding event-listing" id="sec1">
    <div class="col-list-wrap  center-col-list-wrap left-list">
        <div class="container">
            <div class="listsearch-maiwrap box-inside fl-wrap">
                <div class="listsearch-header fl-wrap">
                    <h3>Results For : <span>All Events</span></h3>
                    <div class="listing-view-layout">
                        <ul>
                            <li><a class="grid active" href="#"><i class="fa fa-th-large"></i></a></li>
                            <li><a class="list" href="#"><i class="fa fa-list-ul"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- listsearch-input-wrap  -->
                <div class="listsearch-input-wrap fl-wrap">

                <form action="{{ route('postsearch') }}" method="post">
                   @csrf
                    <div class="listsearch-input-item col-lg-6">
                        <i class="mbri-key single-i"></i>
                        <input type="text" placeholder="Keywords?" value="" name="keyword"/>
                    </div>
                    <div class="listsearch-input-item col-lg-6">
                        <select data-placeholder="All Categories" class="chosen-select" name="categories">
                                <option value="">Select</option>
                            @foreach ( $category as $item)
                                <option value="{{ $item->ecid }}">{{ $item->cname }}</option>
                            @endforeach
                        </select>
                    </div>



					<div class="listsearch-input-text" id="autocomplete-container">
						<label><i class="mbri-map-pin"></i> Enter Addres </label>
						<input type="text" placeholder="Destination , Area , Street" name="area" class="qodef-archive-places-search" value=""/>
						<a  href="#"  class="loc-act qodef-archive-current-location" id="location" onclick="getcityname()"><i class="fa fa-dot-circle-o"></i></a>
					</div>
                    <!-- hidden-listing-filter -->
                    <div class="hidden-listing-filter fl-wrap">
                        <div class="distance-input fl-wrap">
                            <div class="distance-title"> Radius around selected destination <span></span> km</div>
                            <div class="distance-radius-wrap fl-wrap">
                                <input class="distance-radius rangeslider--horizontal" name="range" type="range" min="0" max="100" step="1" value="0" data-title="Radius around selected destination">
                            </div>
                        </div>
                        <!-- Checkboxes -->
                        <div class=" fl-wrap filter-tags">
                            <h4>Filter by Ticket </h4>
                            <div class="filter-tags-wrap">
                                <input id="check-b" type="radio" name="ticket" value="All">
                                <label for="check-b">All Event</label>
                            </div>
                            <div class="filter-tags-wrap">
                                <input id="check-c" type="radio" name="ticket" value="Paid">
                                <label for="check-c">Paid Event</label>
                            </div>
                            <div class="filter-tags-wrap">
                                <input id="check-d" type="radio" name="ticket" value="Free">
                                <label for="check-d">Free Event</label>
                            </div>
                        </div>
                    </div>
                    <!-- hidden-listing-filter end -->
                    <button class="button fs-map-btn" type="submit">Search</button>
                    <div class="more-filter-option">More Filters <span></span></div>
                </div>
                <!-- listsearch-input-wrap end -->
            </form>
            </div>
            <div id="event-filter">
                <div class="nav-holder main-menu">
                    <nav>
                        <ul>
                            <li>
                                <a class="btn-link all active" href="{{ URL::to('/events?type=all') }}">All</a>
                            </li>
                            <li>
                                <a class="btn-link trending" href="{{ URL::to('/events?type=trending') }}">Trending</a>
                                <ul style="position: absolute;right:10%;" >
                                    <li>
                                        <a class="btn-link Nearest" href="{{ URL::to('/events?type=nearest') }}">Nearest</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a class="btn-link upcoming" href="{{ URL::to('/events?type=upcoming') }}">Upcoming</a>
                            </li>
                            <li>
                                <a class="btn-link today" href="{{ URL::to('/events?type=today') }}">Today</a>
                            </li>
                        </ul>

                    </nav>

                </div>

            </div>
            <!-- list-main-wrap-->
            <div class="list-main-wrap fl-wrap card-listing event-listing-wrapper">
            	@foreach($events as $event)
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
                            <p>{{ $event->venue_name }} | {{ $event->event_location }}</p>
                            <p><i class="fa fa-calendar-check-o"></i> <span>{{ $event->event_start_date }} | {{ $event->event_start_time }}</span></p>
                            <p><i class="fa fa-location-arrow"></i> <span style="cursor:pointer" class="get_distance" id="{{ $event->id }}"> {{ Str::limit(App\Http\Controllers\FrontendController::getDistance($userLat,$userLon,$event->latitude,$event->longitude),4)  }} KM Away</span></p>


                            {{-- <p id="long_{{ $event->id }}" style="Display:none">{{ $event->longitude }}</p>
                            <p id="lat_{{ $event->id }}" style=""Display:none">{{ $event->latitude }}</p> --}}


                            <div class="geodir-category-options fl-wrap">
                                <div class="geodir-category-location"><a href="{{ URL::to('/event/details/'.$event->id) }}"><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $event->address }}</a></div>
                            </div>
                        </div>
                    </article>
                </div>
                <!-- listing-item end-->
                @endforeach
                <!-- pagination-->
                <div class="pagination">
                	@if($events->hasPages())
                		@if (!$events->onFirstPage())
                		    <a href="{{ $events->previousPageUrl() }}" class="prevposts-link"><i class="fa fa-caret-left"></i></a>
                		@endif
	                	@for($i = 1; $i <= $totalPages; $i++)
                            @if($events->currentPage() == $i)
                            <a href="{{ URL::to('/events?page='.$i) }}" class="blog-page current-page transition">{{ $i }}</a>
                            @else
                            <a href="{{ URL::to('/events?page='.$i) }}" class="blog-page transition">{{ $i }}</a>
                            @endif
	                    @endfor
	                    @if ($events->hasMorePages())
	                    <a href="{{ $events->nextPageUrl() }}" class="nextposts-link"><i class="fa fa-caret-right"></i></a>
	                    @endif
                    @endif
                    <!-- <a href="#" class="blog-page  transition">2</a> -->
                </div>
            </div>
            <!-- list-main-wrap end-->
        </div>
    </div>
</section>
<!--  section  end-->
<div class="limit-box fl-wrap"></div>
@endsection
@section('script')
<script>
    var header = document.getElementById("event-filter");
    var btns = header.getElementsByClassName("btn-link");
    for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace(" active", "");
            this.className = " active";
            localStorage.ClassName = "active";
        });
    }
    $(document).ready(function() {
        SetClass();
    });

    function SetClass() {
        $('#event-filter li a').removeClass('active');
        var url = window.location.href;
        var get_url = url.split('=');
        $('.' + get_url[1]).addClass(localStorage.ClassName);
    }


 
   function getcityname(){
       let area = document.getElementById('area');
       area.innerText = $city;
   }

@endsection
