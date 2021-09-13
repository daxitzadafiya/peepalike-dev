@extends('frontend.layout.app')

@section('content')


<style>
    #slider-text{
  padding-top: 40px;
  display: block;
}
#slider-text .col-md-6{
  overflow: hidden;
}

#slider-text h2 {
  font-family: 'Josefin Sans', sans-serif;
  font-weight: 400;
  font-size: 30px;
  letter-spacing: 3px;
  margin: 30px auto;
  padding-left: 40px;
}
#slider-text h2::after{
  border-top: 2px solid #c7c7c7;
  content: "";
  position: absolute;
  bottom: 35px;
  width: 100%;
  }

#itemslider h4{
  font-family: 'Josefin Sans', sans-serif;
  font-weight: 400;
  font-size: 12px;
  margin: 10px auto 3px;
}
#itemslider h5{
  font-family: 'Josefin Sans', sans-serif;
  font-weight: bold;
  font-size: 12px;
  margin: 3px auto 2px;
}
#itemslider h6{
  font-family: 'Josefin Sans', sans-serif;
  font-weight: 300;;
  font-size: 10px;
  margin: 2px auto 5px;
}
.badge {
  background: #b20c0c;
  position: absolute;
  height: 40px;
  width: 40px;
  border-radius: 50%;
  line-height: 31px;
  font-family: 'Josefin Sans', sans-serif;
  font-weight: 300;
  font-size: 14px;
  border: 2px solid #FFF;
  box-shadow: 0 0 0 1px #b20c0c;
  top: 5px;
  right: 25%;
}
#slider-control img{
  padding-top: 60%;
  margin: 0 auto;
}
@media screen and (max-width: 992px){
#slider-control img {
  padding-top: 70px;
  margin: 0 auto;
}
}

.carousel-showmanymoveone .carousel-control {
  width: 4%;
  background-image: none;
}
.carousel-showmanymoveone .carousel-control.left {
  margin-left: 5px;
}
.carousel-showmanymoveone .carousel-control.right {
  margin-right: 5px;
}
.carousel-showmanymoveone .cloneditem-1,
.carousel-showmanymoveone .cloneditem-2,
.carousel-showmanymoveone .cloneditem-3,
.carousel-showmanymoveone .cloneditem-4,
.carousel-showmanymoveone .cloneditem-5 {
  display: none;
}
@media all and (min-width: 768px) {
  .carousel-showmanymoveone .carousel-inner > .active.left,
  .carousel-showmanymoveone .carousel-inner > .prev {
    left: -50%;
  }
  .carousel-showmanymoveone .carousel-inner > .active.right,
  .carousel-showmanymoveone .carousel-inner > .next {
    left: 50%;
  }
  .carousel-showmanymoveone .carousel-inner > .left,
  .carousel-showmanymoveone .carousel-inner > .prev.right,
  .carousel-showmanymoveone .carousel-inner > .active {
    left: 0;
  }
  .carousel-showmanymoveone .carousel-inner .cloneditem-1 {
    display: block;
  }
}
@media all and (min-width: 768px) and (transform-3d), all and (min-width: 768px) and (-webkit-transform-3d) {
  .carousel-showmanymoveone .carousel-inner > .item.active.right,
  .carousel-showmanymoveone .carousel-inner > .item.next {
    -webkit-transform: translate3d(50%, 0, 0);
    transform: translate3d(50%, 0, 0);
    left: 0;
  }
  .carousel-showmanymoveone .carousel-inner > .item.active.left,
  .carousel-showmanymoveone .carousel-inner > .item.prev {
    -webkit-transform: translate3d(-50%, 0, 0);
    transform: translate3d(-50%, 0, 0);
    left: 0;
  }
  .carousel-showmanymoveone .carousel-inner > .item.left,
  .carousel-showmanymoveone .carousel-inner > .item.prev.right,
  .carousel-showmanymoveone .carousel-inner > .item.active {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
    left: 0;
  }
}
@media all and (min-width: 992px) {
  .carousel-showmanymoveone .carousel-inner > .active.left,
  .carousel-showmanymoveone .carousel-inner > .prev {
    left: -16.666%;
  }
  .carousel-showmanymoveone .carousel-inner > .active.right,
  .carousel-showmanymoveone .carousel-inner > .next {
    left: 16.666%;
  }
  .carousel-showmanymoveone .carousel-inner > .left,
  .carousel-showmanymoveone .carousel-inner > .prev.right,
  .carousel-showmanymoveone .carousel-inner > .active {
    left: 0;
  }
  .carousel-showmanymoveone .carousel-inner .cloneditem-2,
  .carousel-showmanymoveone .carousel-inner .cloneditem-3,
  .carousel-showmanymoveone .carousel-inner .cloneditem-4,
  .carousel-showmanymoveone .carousel-inner .cloneditem-5,
  .carousel-showmanymoveone .carousel-inner .cloneditem-6  {
    display: block;
  }
}
@media all and (min-width: 992px) and (transform-3d), all and (min-width: 992px) and (-webkit-transform-3d) {
  .carousel-showmanymoveone .carousel-inner > .item.active.right,
  .carousel-showmanymoveone .carousel-inner > .item.next {
    -webkit-transform: translate3d(16.666%, 0, 0);
    transform: translate3d(16.666%, 0, 0);
    left: 0;
  }
  .carousel-showmanymoveone .carousel-inner > .item.active.left,
  .carousel-showmanymoveone .carousel-inner > .item.prev {
    -webkit-transform: translate3d(-16.666%, 0, 0);
    transform: translate3d(-16.666%, 0, 0);
    left: 0;
  }
  .carousel-showmanymoveone .carousel-inner > .item.left,
  .carousel-showmanymoveone .carousel-inner > .item.prev.right,
  .carousel-showmanymoveone .carousel-inner > .item.active {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
    left: 0;
  }
}

</style>

    <!-- First Section -->
    <div class="get-there">
        <div class="get-there-inner">
            <h2>Your Number One Service Provider<b>Social Media Marketers, Doctor, Or Mechanic On Demand Just For You</b></h2>
            <span>
         <!--<a href="sign-up-rider">Sign up to Job</a>-->
         <a href="{{ route('provider.register') }}" class="active">become a Service Provider</a>
      </span>
            <div style="clear:both;"></div>
        </div>
    </div>
    <!-- End: First Section -->
    <!-- -->
    <div class="home-hero-page">
        <div class="home-hero-page-left">
            <div class="home-hero-page-left-text">
         <span>
            <a href="{{ route('provider.register') }}"><em>Signup as Provider</em></a>
            <p> Are you looking for influencers, or Have blocked toilet? Or need a home cleaner? Do you need a DJ? Or the microwave gone bust? Whatever needs tending, or fixing, Taskmate is the number one solution for you. </p>
         </span>
            </div>
        </div>
        <div class="home-hero-page-right">
            <div class="home-hero-page-right-text">
         <span>
            <p>
               The text to display in homepage after user login.
            </p>
            <a href="{{ route('user.register') }}"><em>
            Signup as User			</em></a>
         </span>
            </div>
        </div>
        
    </div>
    <!-- End: Second Section -->
    <!-- Third Section -->
    <div class="tap-app-ride">
        <div class="tap-app-ride-inner">
            <h2>Either you need Heater Maintenance Or Fixing That Tap The Digital Way</h2>
            <p>Whether you need a wedding planner, or a home design & Construction, all this and more are just a tap away with Taskmate &ndash; your personal provider of any service you want on demand. Just tap the app, choose the professional that you require, tutor or health and wellness coach, or any other, and get the job done in a jiffy.</p>
            <div style="clear:both;"></div>
        </div>
    </div>
    <!-- End: Third Section -->
    <div class="home-body-mid-part">
        <div class="home-body-mid-part-inner">
            <ul>
                <li>
                    <div class="home-body-mid-img">
                        <img src="{{ asset('frontend/assets/img/page/home/1_ufx_EN.jpg') }}" alt="home1" />
                    </div>
                    <h3>Licensed AndSkilled Professionals Who Do Your Bidding</h3>
                    <p>Small or big, cleaning or babysitting, no job is beyond our reach. Do not take our word for it. Tap the app and find out for yourself the services of licensed, qualified and highly skilled professionals, who are the best in their individual industry.</p>
                </li>
                <li>
                    <div class="home-body-mid-img">
                        <img src="{{ asset('frontend/assets/img/page/home/2_ufx_EN.jpg') }}" alt="home2" />
                    </div>
                    <h3>Affordable,Honest And Reliable</h3>
                    <p>All our professionals come with a clean bill of health as far as their credibility is concerned. You can rest assured that you will get the best services at prices that are convenient to your pocket too. Whether we charge by the hour or by the session, you will get reasonable rates from all our professionals for the best services.</p>
                </li>
                <li>
                    <div class="home-body-mid-img">
                        <img src="{{ asset('frontend/assets/img/page/home/3_EN.jpg') }}" alt="home3" />
                    </div>
                    <h3>Guaranteed ServiceWith A Smile For All Your Jobs</h3>
                    <p>All our professionals take pride in their work and will ensure that they give you their very best, leaving you satisfied. We guarantee that you will use our services again and again with the confidence that we deliver what we say &ndash; the best! Just tap the app and leave the rest to us while you sit back and relax.</p>
                </li>
            </ul>
            <div style="clear:both;"></div>
        </div>
    </div>
    <!-- -->
    <div class="home-mobile-app">
        <div class="home-mobile-app-inner">
            <div class="home-mobile-app-left os-animation" data-os-animation="fadeInLeft" data-os-animation-delay="0.2s">
                <img src="{{ asset('frontend/assets/img/page/home/mobile-img-del-ufx_EN.png') }}" alt="">
            </div>
            <div class="home-mobile-app-right os-animation" data-os-animation="fadeInRight" data-os-animation-delay="0.2s">
                <h3>THAT HIGHLY PROFESSIONAL SERVICE PROVIDER JUST FOR YOU</h3>
                <p>Tap the TASKMATE USER app, select a SERVICE PRO, get a pro without looking back. That is what our app will do. No words are necessary when you work with us because we know exactly what you want. Request and save with us &ndash; at the comfort of your home.</p>
                <p><span><a href="{{ route('about') }}"><em>MORE INFO</em></a></span></p>
            </div>
            <div style="clear:both;"></div>
        </div>
    </div>
    <!-- -->
    <!-- -->
    <!-- -->
    
    
    <div class="gallery-part">
        <div class="gallery-page" id="itemslider">
            <div class="gallery-page-inner">
                <h2>Service Providers</h2>
                <em>Our  family welcomes you on board with a smile. Just look out for them!</em>
                <div class="gallery-page-inner mt-2">
              
                    <div id="imageCarousel" class="carousel slide" data-ride="carousel">
                      <ol class="carousel-indicators">
                         <li data-target="#home_main-slider" data-slide-to="1" class="carousel-1">
                         </li>
                    </ol>
                    

                       
                    
                    <div class="carousel-inner">
                    
                    @foreach($users->chunk(4) as $index => $usercollection)
                       <div class="item {{ $loop->first ? 'active' : '' }}">
                         <div class="row">
                        @foreach($usercollection as $user)
                           <div id="box-2" class="box">
                                <b>
                                    <img  width="290" height="270" id="image-1" class="mySlides" src="{{ $user->image }}"/>
                                </b>
                                
                                  <span class="caption full-caption">
                                    <h3>
                                        <p>{{ $user->first_name}} {{ $user->last_name}}
                                        </p>
                                        <p>Ratings :
                                        @for($i =1; $i <= 5; $i++)
                                            <span style="color: yellow" class="fa fa-star {{ 5 >= $i ? 'checked' : ''}}"></span>
                                        @endfor
                                        </p>
                                        <p>
                                        @foreach($address as $addr)
                                            <?php 
                                                if($user->id == $addr->user_id){
                                                    echo $addr->city ;
                                                }
                                            ?>
                                        @endforeach</p>
                                       
                                    </h3>
                                </span>
                              
                            </div>
                            @endforeach
                         </div>
                       </div>
                       @endforeach
                       
                      </div>
                      
                      <a class="left carousel-control" href="#imageCarousel" role="button" data-slide="prev">
                          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                          <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#imageCarousel" role="button" data-slide="next">
                          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                          <span class="sr-only">Next</span>
                        </a>
                     </div>
                </div>
                </div>
            </div>
        </div>
   
    
@endsection