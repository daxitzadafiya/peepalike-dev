@extends('eventfrontend.layout.newtheme-layout')
@section('title', 'Blogs')
 @section('keywords', $metaDetail->meta_tag)
@section('description', $metaDetail->meta_description)
@section('content')
<style>
    .list-single-tags {
        color: #000 !important;
    }
    .gray-section{
        font-size: 14px;
    }
    .list-single-main-item p{
        font-size: 14px;
    }
    .list-single-main-item-title h3{
        font-size: 28px;
    }
    .blog-detail .slick-slide-item img{
        cursor: pointer;
    }
    .blog-detail .sw-btn.swiper-button-prev {
        left: 22px;
    }
    .blog-detail .sw-btn.swiper-button-next {
        right: 22px;
    }
    .similar-blog-category{
        margin: 8px 0;
    }
    .similar-blog-category span{
        color: #53b7fe !important;
        text-transform: capitalize;
    }
    .view-detial{
        padding: 0 4px 0 10px !important;
    }
    @media(max-width:768px) and (min-width:433px){
        .blog-detail .swiper-button-prev {
            left: 20px;
        }
        .blog-detail .sw-btn{
            width: 25px;
            height: 25px;
            line-height: 25px;
        }
        .blog-detail .swiper-button-next {
            right: 20px;
        }
    }
    @media(max-width:432px) and (min-width:320px){
        .blog-detail .swiper-button-prev {
            left: 10px;
        }
        .blog-detail .swiper-button-next {
            right: 10px;
        }
        .blog-detail .sw-btn{
            width: 25px;
            height: 25px;
            line-height: 25px;
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
<section class="gray-section blog-detail" id="sec1">
    <div class="container">
        @if($BlogList)
            @foreach ($BlogList as $value)
                {{-- <div class="row">
                    <!--box-widget-wrap -->
                    <div class="col-md-12">
                        <div class="box-widget-wrap">
                            <!--box-widget-item -->
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
                            <!--box-widget-item end -->
                            <!--box-widget-item -->
                            <div class="box-widget-item fl-wrap">
                                <div class="box-widget-item-header">
                                    <h3>Popular posts : </h3>
                                </div>
                                <div class="box-widget widget-posts blog-widgets">
                                    <div class="box-widget-content">
                                        <ul>
                                            <li class="clearfix">
                                                <a href="#"  class="widget-posts-img"><img src="{{ asset('newtheme/images/all/1.jpg') }}"  alt=""></a>
                                                <div class="widget-posts-descr">
                                                    <a href="#" title="">Cafe "Lollipop"</a>
                                                    <span class="widget-posts-date"><i class="fa fa-calendar-check-o"></i> 21 Mar 2017 </span>
                                                </div>
                                            </li>
                                            <li class="clearfix">
                                                <a href="#"  class="widget-posts-img"><img src="{{ asset('newtheme/images/all/9.jpg') }}"  alt=""></a>
                                                <div class="widget-posts-descr">
                                                    <a href="#" title=""> Apartment in the Center</a>
                                                    <span class="widget-posts-date"><i class="fa fa-calendar-check-o"></i> 7 Mar 2017 </span>
                                                </div>
                                            </li>
                                            <li class="clearfix">
                                                <a href="#"  class="widget-posts-img"><img src="{{ asset('newtheme/images/all/18.jpg') }}"  alt=""></a>
                                                <div class="widget-posts-descr">
                                                    <a href="#" title="">Event in City Mol</a>
                                                    <span class="widget-posts-date"><i class="fa fa-calendar-check-o"></i> 7 Mar 2017 </span>
                                                </div>
                                            </li>
                                            <li class="clearfix">
                                                <a href="#"  class="widget-posts-img"><img src="{{ asset('newtheme/images/all/19.jpg') }}"  alt=""></a>
                                                <div class="widget-posts-descr">
                                                    <a href="#" title="">Event in City Mol</a>
                                                    <span class="widget-posts-date"><i class="fa fa-calendar-check-o"></i> 7 Mar 2017 </span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--box-widget-item end -->
                            <!--box-widget-item -->
                            <div class="box-widget-item fl-wrap">
                                <div class="box-widget-item-header">
                                    <h3>Tags: </h3>
                                </div>
                                <div class="list-single-tags tags-stylwrap">
                                    <a href="#">Event</a>
                                    <a href="#">Design</a>
                                    <a href="#">Photography</a>
                                    <a href="#">Trends</a>
                                    <a href="#">Video</a>
                                    <a href="#">News</a>
                                </div>
                            </div>
                            <!--box-widget-item end -->
                            <!--box-widget-item -->
                            <div class="box-widget-item fl-wrap">
                                <div class="box-widget-item-header">
                                    <h3>Categories : </h3>
                                </div>
                                <div class="box-widget">
                                    <div class="box-widget-content">
                                        <ul class="cat-item">
                                            @if($Category)
                                                @foreach ($Category as $result)
                                                <li><a href="#">{{$value->category_type}}</a> <span>({{$Category}})</span></li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--box-widget-item end -->
                        </div>
                    </div>
                    <!--box-widget-wrap end -->
                </div> --}}
                <div class="row">
                    <div class="col-md-8">
                        <div class="list-single-main-wrapper fl-wrap" id="sec2">
                            <!-- article> -->
                            <article>
                                <div class="list-single-main-media fl-wrap">
                                    <div class="single-slider-wrapper fl-wrap">
                                        <div class="single-slider fl-wrap"  >
                                            <div class="slick-slide-item"><img src="@if($value->blog_image != '') {{ $value->blog_image }} @else {{ 'http://placehold.it/200x200' }}  @endif " alt="profile pic"> </div>
                                            {{-- <div class="slick-slide-item"><img src="{{ asset('newtheme/images/all/9.jpg') }}" alt=""></div>
                                            <div class="slick-slide-item"><img src="{{ asset('newtheme/images/all/10.jpg') }}" alt=""></div> --}}
                                        </div>
                                        <div class="swiper-button-prev sw-btn"><i class="fa fa-long-arrow-left"></i></div>
                                        <div class="swiper-button-next sw-btn"><i class="fa fa-long-arrow-right"></i></div>
                                    </div>
                                </div>
                                <div class="list-single-main-item fl-wrap">
                                    <div class="list-single-main-item-title fl-wrap">
                                        <h3><a href="#">{{ $value->blog_title}}</a></h3>
                                    </div>
                                    {!! $value->blog_content !!}
                                    {{-- <img src="{{ asset('newtheme/images/avatar/4.jpg') }}" alt=""> --}}
                                    <div class="blog_detail">
                                        <div class="post-author"><a href="#"><span>By , {{$value->blog_author}}</span></a></div>
                                        <div class="post-opt">
                                            <ul>
                                                <li><i class="fa fa-calendar-check-o"></i> <span>{{date('d M Y',strtotime($value->created_at))}}</span></li>
                                                <li><i class="fa fa-eye"></i> <span>{{$value->views}}</span></li>
                                                <ul  style="float:right;">
                                                    @foreach($shareComponent as $key => $value)
                                                        @if($key == "facebook")
                                                            <li><a href=" {{ $value }}" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                                        @elseif($key== "twitter")
                                                            <li><a href="{{ $value }}" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                                        @elseif($key == "linkedin")
                                                            <li><a href="{{ $value }}" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                                        @endif

                                                    @endforeach
                                                </ul>
                                            </ul>

                                        </div>

                                        <span class="fw-separator"></span>
                                        <div class="list-single-main-item-title fl-wrap">
                                            <h3>Tags</h3>
                                        </div>
                                        <div class="list-single-tags tags-stylwrap blog-tags">
                                            @if(isset($value->blog_tags))
                                                @foreach (explode(',',$value->blog_tags) as $val)
                                                    <a href="#">{{$val}}</a>
                                                @endforeach
                                            @else
                                                <a href="#">{{'-'}}</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="tag-listing-wrapper">
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
                                {{-- <div class="box-widget-item fl-wrap">
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
                                </div>                  --}}
                            </div>
                        </div>
                        <div class="category-listing-wrapper">
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
                        <div class="box-widget-item fl-wrap">
                            <div class="box-widget-item-header">
                                <h3>Similar Blogs : </h3>
                            </div>
                            <div class="box-widget widget-posts blog-widgets">
                                <div class="box-widget-content">
                                    <ul>
                                        @if (isset($similarBlog))
                                            @foreach ($similarBlog as $res)
                                                <li class="clearfix">
                                                    <a href="/blogs/details/{{$res->id}}" class="widget-posts-img"><img src="@if($res->blog_image != '') {{ $res->blog_image }} @else {{ 'http://placehold.it/200x200' }}  @endif"  alt=""></a>
                                                    <div class="widget-posts-descr">
                                                        <a href="/blogs/details/{{$res->id}}" title="">{{ $res->blog_title}}</a>
                                                        <div class="similar-blog-category">
                                                            <span title="">{{ $res->category_type}}</span>
                                                        </div>
                                                        <span class="widget-posts-date"><i class="fa fa-calendar-check-o"></i>{{date('d M Y',strtotime($res->created_at))}} <i class="fa fa-eye view-detial"></i>{{$res->views}}</span>

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
            @endforeach
        @endif
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
</script>
@endsection
