@extends('eventfrontend.layout.newtheme-layout')
@section('title', 'Blogs')
@section('content')
<style>
    .blog-content{
        width: 100%;
        height: 100px;
        overflow: hidden;
        text-overflow: ellipsis;
        font-size: 14px;
        text-align: justify;
    }
    .tags-info{
        width: 100%;
        height: 76px;
        overflow: auto;
    }
    .blog-content p{
        font-size: 14px;
        text-align: justify;
    }
    .blog-detail-wrapper .list-single-tags a:hover{
        color:#fff !important;
    }
    .blog-detail-wrapper .list-single-main-media{
        border-radius: 0px;
        overflow: unset;
        margin-bottom: 0px;
    }
    .blog-detail-wrapper .list-single-main-item {
        border-radius: 0px;
    }
    .blog-detail-wrapper .list-single-main-item-title h3{
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
    .blog-detail-wrapper .list-single-main-item-title h3:hover{
        color: #53b7fe;
    }
    .blog-detail-wrapper .list-single-main-item-title {
        margin: 0;
    }
    .blog-detail-wrapper .list-single-main-media img{
        height: 260px;
        background: no-repeat;
        object-fit: cover;
        -webkit-transition: all 2000ms cubic-bezier(.19,1,.22,1) 0ms;
        -webkit-transform: translateZ(0);
        transform: translateZ(0);
        transition: all 2000ms cubic-bezier(.19,1,.22,1) 0ms;
    }
    .blog-detail-wrapper .list-single-main-media:hover img{
        -webkit-transform: scale(1.15);
        -moz-transform:scale(1.15);
        transform: scale(1.15);
    }
    .tag-listing-wrapper,.category-listing-wrapper{
        padding: 25px 17px 0;
    }
    .blog-detail-wrapper .list-single-tags a:hover {
        color: #4fb6fa !important;
    }
    .blog_detail .post-author{
        height: 30px !important;
        width: 100% !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
        white-space: nowrap !important;
        text-align: left !important;
    }
    @media(max-width:1162px) and (min-width:1025px){
        .blog-author-info{
            display: grid;
            text-align: left;
        }
    }
    @media(max-width:1024px) and (min-width:993px){
        .blog-detail-wrapper .list-single-main-item-title h3 {
            width: 235px;
        }
        .blog-author-info{
            display: grid;
            text-align: left;
        }
    }
    @media(max-width:992px) and (min-width:769px){
        .blog-detail-wrapper .list-single-main-item-title h3 {
            width: 170px;
        }
        .post-author{
            margin-right: 0;
        }
        .blog-detail-wrapper .btn {
            padding: 12px 28px;
        }
        .blog-author-info{
            display: grid;
            text-align: left;
        }
    }
    @media(max-width:432px) and (min-width:320px){
        .blog-detail-wrapper .list-single-main-item-title h3 {
            width: 200px;
        }
        .blog-author-info{
            display: grid;
            text-align: left;
        }
    }
</style>
 <!--section -->
{{-- <section class="parallax-section" data-scrollax-parent="true">
    <div class="bg par-elem "  data-bg="{{ asset('newtheme/images/all/2.jpg') }}" data-scrollax="properties: { translateY: '30%' }"></div>
    <div class="overlay"></div>
    <div class="container">
        <div class="section-title center-align">
            <h2><span>Our News - Blog</span></h2>
            <div class="breadcrumbs fl-wrap"><a href="#">Home</a><span>Blog</span></div>
            <span class="section-separator"></span>
        </div>
    </div>
    <div class="header-sec-link">
        <div class="container"><a href="#sec1" class="custom-scroll-link">Let's Start</a></div>
    </div>
</section> --}}
<!-- section end -->
<!--section -->
<section class="gray-bg no-pading no-top-padding blog-detail-wrapper" id="sec1">
    <div class="col-list-wrap center-col-list-wrap left-list">
        <div class="container">
            <div class="listsearch-maiwrap box-inside fl-wrap">
                <div class="listsearch-header fl-wrap">
                    <h3>Results For : <span>All Blogs</span></h3>
                    <div class="listing-view-layout">
                        <ul>
                            <li><a class="grid active" href="#"><i class="fa fa-th-large"></i></a></li>
                            <li><a class="list" href="#"><i class="fa fa-list-ul"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 tag-listing-wrapper">
                        <div class="box-widget-wrap">
                            <div class="box-widget-item fl-wrap">
                                <div class="box-widget-item-header">
                                    <h3>Search In blog : </h3>
                                </div>
                                <div class="box-widget search-widget">
                                    <form action="#" class="fl-wrap">
                                        <input name="se" id="se" type="text" class="search" placeholder="Search.." value="Search..." />
                                        <button class="search-submit" id="submit_btn"><i class="fa fa-search transition"></i> </button>
                                    </form>
                                </div>
                            </div>
                            <div class="box-widget-item fl-wrap">
                                <div class="box-widget-item-header">
                                    <h3>Tags: </h3>
                                </div>
                                <div class="list-single-tags tags-stylwrap">
                                    @if ($Tags)
                                        @foreach ($Tags as $value)
                                            <a href="#">{{$value->tag_name}}</a>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 category-listing-wrapper">
                        <div class="box-widget-item fl-wrap">
                            <div class="box-widget-item-header">
                                <h3>Categories : </h3>
                            </div>
                            <div class="box-widget">
                                <div class="box-widget-content">
                                    <ul class="cat-item">
                                        @if ($Category)
                                            @foreach ($Category as $value)
                                                <li><a href="#">{{$value->category_name}}</a></li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="list-main-wrap fl-wrap card-listing">
                @if($BlogList)
                    @foreach ($BlogList as $value)
                    <div class="listing-item">
                        <!-- article> -->
                        <article class="geodir-category-listing fl-wrap">
                            <div class="list-single-main-media fl-wrap">
                                <div class="single-slider-wrapper fl-wrap">
                                    <div class="single-slider fl-wrap">
                                        <a href="/blogs/details/{{$value->id}}" onclick="ViewsCount({{$value->id}})">
                                        <div class="slick-slide-item"><img src="@if($value->blog_image != '') {{ $value->blog_image }} @else {{ 'http://placehold.it/200x200' }}  @endif " alt="profile pic"> </div>
                                        </a>
                                        {{-- <div class="slick-slide-item"><img src="{{ asset('newtheme/images/all/9.jpg') }}" alt=""></div>
                                        <div class="slick-slide-item"><img src="{{ asset('newtheme/images/all/10.jpg') }}" alt=""></div> --}}
                                    </div>
                                    {{-- <div class="swiper-button-prev sw-btn"><i class="fa fa-long-arrow-left"></i></div>
                                    <div class="swiper-button-next sw-btn"><i class="fa fa-long-arrow-right"></i></div> --}}
                                </div>
                            </div>
                            <div class="list-single-main-item fl-wrap">
                                <a href="/blogs/details/{{$value->id}}" onclick="ViewsCount({{$value->id}})">
                                    <div class="list-single-main-item-title fl-wrap">
                                        <h3>{{ $value->blog_title}}</h3>
                                    </div>
                                </a>
                                <div class="blog-content">
                                    {!! Illuminate\Support\Str::limit($value->blog_content,300) !!}
                                </div>
                                {{-- <img src="{{ asset('newtheme/images/avatar/4.jpg') }}" alt=""> --}}
                                <div class="blog_detail">
                                    <div class="blog-author-info">
                                        <div class="post-author"><span>By , {{$value->blog_author}}</span></div>
                                        <div class="post-opt">
                                            <ul>
                                                <li><i class="fa fa-calendar-check-o"></i> <span>{{date('d M Y',strtotime($value->created_at))}}</span></li>
                                                <li><i class="fa fa-eye"></i> <span>{{$value->views}}</span></li>

                                                {{-- <li><i class="fa fa-tags"></i> <a href="#">Photography</a> , <a href="#">Design</a> </li> --}}
                                            </ul>
                                        </div>
                                    </div>
                                    <span class="fw-separator"></span>
                                    <div class="list-single-main-item-title fl-wrap">
                                        <h3>Tags</h3>
                                    </div>
                                    <div class="tags-stylwrap">
                                        <div class="list-single-tags tags-stylwrap tags-info">
                                        @if($value->blog_tags != '')
                                            @foreach (explode(',',$value->blog_tags) as $val)
                                                <a href="#">{{$val}}</a>
                                            @endforeach
                                        @else
                                            <a href="#">{{'-'}}</a>
                                        @endif
                                        </div>
                                    </div>
                                    <span class="fw-separator"></span>
                                    <a href="/blogs/details/{{$value->id}}" onclick="ViewsCount({{$value->id}})" class="btn transparent-btn float-btn">Read more<i class="fa fa-eye"></i></a>
                                </div>
                            </div>
                        </article>
                    </div>
                    <!-- pagination-->
                    @endforeach
                    <div class="pagination">
                        @if($BlogList->hasPages())
                            @if (!$BlogList->onFirstPage())
                                <a href="{{ $BlogList->previousPageUrl() }}" class="prevposts-link"><i class="fa fa-caret-left"></i></a>
                            @endif
                            @for($i = 1; $i <= $totalPages; $i++)
                                @if($BlogList->currentPage() == $i)
                                    <a href="{{ URL::to('/blogs?page='.$i) }}" class="blog-page current-page transition">{{ $i }}</a>
                                @else
                                    <a href="{{ URL::to('/blogs?page='.$i) }}" class="blog-page transition">{{ $i }}</a>
                                @endif
                            @endfor
                            @if ($BlogList->hasMorePages())
                                <a href="{{ $BlogList->nextPageUrl() }}" class="nextposts-link"><i class="fa fa-caret-right"></i></a>
                            @endif
                        @endif
                        <!-- <a href="#" class="blog-page  transition">2</a> -->
                    </div>
                @endif
                <!--box-widget-wrap end -->
            </div>
        </div>
    </div>
</section>
<div class="limit-box fl-wrap"></div>
@endsection
@section('script')
<script>
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
</script>
@endsection
