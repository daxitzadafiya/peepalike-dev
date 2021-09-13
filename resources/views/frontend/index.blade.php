@extends('frontend.layout1.app')

@section('content')
    <link
      href="{{ asset('frontend/assets1/vendor/bootstrap/css/bootstrap.min.css') }}"
      rel="stylesheet"
    />
    <link href="{{ asset('frontend/assets1/vendor/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/assets1/vendor/icofont/icofont.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/assets1/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/assets1/vendor/venobox/venobox.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/assets1/owl.carousel/assets/owl.carousel.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/assets1/vendor/aos/aos.css') }}" rel="stylesheet" />
    <!--App Carousel-->
    <link href="{{ asset('frontend/assets1/app-carousel/assets/vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/assets1/app-carousel/assets/vendor/venobox/venobox.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/assets1/app-carousel/assets/vendor/aos/aos.css') }}" rel="stylesheet">
<meta name="google-site-verification" content="ld3TQjbjvGNpvGLtdT4Kk8xDxDrNf_shW6EDQA_H_XM" />
  <!-- Template Main CSS File -->
  <link href="{{ asset('frontend/assets1/app-carousel/assets/css/style.css') }}" rel="stylesheet">

    
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex justify-cntent-center align-items-center">
      <div
        id="heroCarousel"
        class="container carousel carousel-fade"
        data-ride="carousel">
        <!-- Slide 1 -->
        <div class="carousel-item active">
          <div class="carousel-container">
            <h2 class="animate__animated animate__fadeInDown">
              Welcome to <span>Readiwork</span>
            </h2>
            <p class="animate__animated animate__fadeInUp">
              Your Number One Service Provider.
            </p>
            <p>
              Social Media Marketers, Doctor, Or Mechanic On Demand Just For You
              .
            </p>
            <a
              href="https://www.Readiwork.com/sign-up-provider"
              class="btn-get-started animate__animated animate__fadeInUp"
              >Become a service Provider</a
            >
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item">
          <div class="carousel-container">
            <h2 class="animate__animated animate__fadeInDown">
              Either you need heater maintenance or fixing that tap the Digital
              Way
            </h2>
            <p class="animate__animated animate__fadeInUp">
              Whether you need a wedding planner, or a home design &
              Construction, all this and more are just a tap away with Readiwork
              – your personal provider of any service you want on demand. Just
              tap the app, choose the professional that you require, tutor or
              health and wellness coach, or any other, and get the job done in a
              jiffy.
            </p>
            <a
              href=""
              class="btn-get-started animate__animated animate__fadeInUp"
              >Become a service Provider</a
            >
          </div>
        </div>

        <a
          class="carousel-control-prev"
          href="#heroCarousel"
          role="button"
          data-slide="prev"
        >
          <span
            class="carousel-control-prev-icon bx bx-chevron-left"
            aria-hidden="true"
          ></span>
          <span class="sr-only">Previous</span>
        </a>

        <a
          class="carousel-control-next"
          href="#heroCarousel"
          role="button"
          data-slide="next"
        >
          <span
            class="carousel-control-next-icon bx bx-chevron-right"
            aria-hidden="true"
          ></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </section>
    <!-- End Hero -->

    <main id="main">
      <!-- ======= Services Section ======= -->
      <section class="services">
        <div class="container">
          <div class="row">
            <div
              class="col-md-6 col-lg-4 d-flex align-items-stretch"
              data-aos="fade-up"
            >
              <div class="icon-box icon-box-pink">
                <div class="icon"><i class="bx bxl-dribbble"></i></div>
                <h4 class="title">
                  <a href=""
                    >Licensed & Skilled Professionals Who Do Your Bidding</a
                  >
                </h4>
                <p class="description">
                  Small or big, cleaning or babysitting, no job is beyond our
                  reach. Do not take our word for it. Tap the app and find out
                  for yourself the services of licensed, qualified and highly
                  skilled professionals, who are the best in their individual
                  industry.
                </p>
              </div>
            </div>

            <div
              class="col-md-6 col-lg-4 d-flex align-items-stretch"
              data-aos="fade-up"
              data-aos-delay="100"
            >
              <div class="icon-box icon-box-cyan">
                <div class="icon"><i class="bx bx-file"></i></div>
                <h4 class="title">
                  <a href="">Affordable, Honest And Reliable</a>
                </h4>
                <p class="description">
                  All our professionals come with a clean bill of health as far
                  as their credibility is concerned. You can rest assured that
                  you will get the best services at prices that are convenient
                  to your pocket too. Whether we charge by the hour or by the
                  session, you will get reasonable rates from all our
                  professionals for the best services.
                </p>
              </div>
            </div>

            <div
              class="col-md-6 col-lg-4 d-flex align-items-stretch"
              data-aos="fade-up"
              data-aos-delay="200"
            >
              <div class="icon-box icon-box-green">
                <div class="icon"><i class="bx bx-tachometer"></i></div>
                <h4 class="title">
                  <a href=""
                    >Guaranteed Service With A Smile For All Your Jobs</a
                  >
                </h4>
                <p class="description">
                  All our professionals take pride in their work and will ensure
                  that they give you their very best, leaving you satisfied. We
                  guarantee that you will use our services again and again with
                  the confidence that we deliver what we say – the best! Just
                  tap the app and leave the rest to us while you sit back and
                  relax.
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- End Services Section -->
      <!-- slideshow for service provider-->

      <div
        class="container-fluid"
        style="background-color: #f3f8fa; padding: 50px;"
      >
        <h1 class="text-center mb-3">Service Providers</h1>
        <p class="text-center mb-3">
          Our family welcomes you on board with a smile. Just look out for them!
        </p>
        <div id="myCarousel" class="carousel slide" data-ride="carousel" style="margin-right:0;">
          <div class="carousel-inner row w-100 mx-auto" id="card-row" >
            <div class="carousel-item col-md-4 active">
            
              <div class="card" >
                <img
                  class="card-img-top img-fluid"
                  src="{{ asset('frontend/assets1/img/features-1.svg') }}"
                  alt="Card image cap"
                />
                <div class="card-body">
                  <h4 class="card-title">Our Professionals</h4>
                  <p class="card-text text-center">
                      Readiwork is a platforom with an aim of instantly connecting skilled taskers to help with running errands. At Readiwork, we’re building more than a product. We’re building local economies and stronger communities.
                  </p>
                  <p class="card-text">
                    Have a look at our Professionals.
                  </p>
                </div>
              </div>
            </div>
           @foreach($users->chunk(4) as $index => $usercollection)
            @foreach($usercollection as $user)
            
            <div class="carousel-item col-md-4">
            
              <div class="card">
                <img
                  class="card-img-top img-fluid"
                  src="{{ $user->image }}"
                  alt="Card image cap"
                />
                <div class="card-body">
                  <h4 class="card-title">{{ $user->first_name}} {{ $user->last_name}}</h4>
                  <p class="card-text">
                    @foreach($address as $addr)
                                            <?php 
                                                if($user->id == $addr->user_id){
                                                    echo $addr->city ;
                                                }
                                            ?>
                                        @endforeach</p>
                  </p>
                  <p class="card-text">
                    <p>Ratings :
                                        @for($i =1; $i <= 5; $i++)
                                            <span style="color: yellow" class="fa fa-star {{ 5 >= $i ? 'checked' : ''}}"></span>
                                        @endfor
                                        </p>
                  </p>
                </div>
              </div>
            </div>
            @endforeach
            @endforeach
            
          </div>
          <a
            class="carousel-control-prev"
            href="#myCarousel"
            role="button"
            data-slide="prev"
          >
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a
            class="carousel-control-next"
            href="#myCarousel"
            role="button"
            data-slide="next"
          >
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>

      <!--slideshow for service provider ends here-->

      <!-- ======= Features Section ======= -->
      <section class="features">
        <div class="container">
          <div class="row" data-aos="fade-up">
            <div class="col-md-5">
              <img src="{{ asset('frontend/assets1/img/features-1.svg') }}" class="img-fluid" alt="" />
            </div>
            <div class="col-md-7 pt-4">
              <h3>
                THAT HIGHLY PROFESSIONAL SERVICE PROVIDER JUST FOR YOU
              </h3>
              <p>
                Tap the Readiwork USER app, select a SERVICE PRO, get a pro
                without looking back. That is what our app will do. No words are
                necessary when you work with us because we know exactly what you
                want. Request and save with us – at the comfort of your home.
              </p>
              <a
                href=""
                class="btn-get-started animate__animated animate__fadeInUp"
                ><em>more info >>> </em></a
              >
            </div>
          </div>
        </div>
      </section>
         <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery">
      <div class="container">

        <div class="section-title">
          <h2>Gallery</h2>
          <p>Readiwork at a Glance</p>
        </div>

        <div class="owl-carousel gallery-carousel" data-aos="fade-up">
          <a href="{{ asset('frontend/assets1/app-carousel/assets/img/gallery/gallery-1.png') }}" class="venobox" data-gall="gallery-carousel"><img src="{{ asset('frontend/assets1/app-carousel/assets/img/gallery/gallery-1.png') }}" alt=""></a>
          <a href="{{ asset('frontend/assets1/app-carousel/assets/img/gallery/gallery-2.png') }}" class="venobox" data-gall="gallery-carousel"><img src="{{ asset('frontend/assets1/app-carousel/assets/img/gallery/gallery-2.png') }}" alt=""></a>
          <a href="{{ asset('frontend/assets1/app-carousel/assets/img/gallery/gallery-3.png') }}" class="venobox" data-gall="gallery-carousel"><img src="{{ asset('frontend/assets1/app-carousel/assets/img/gallery/gallery-3.png') }}" alt=""></a>
          <a href="{{ asset('frontend/assets1/app-carousel/assets/img/gallery/gallery-4.png') }}" class="venobox" data-gall="gallery-carousel"><img src="{{ asset('frontend/assets1/app-carousel/assets/img/gallery/gallery-4.png') }}" alt=""></a>
        </div>

      </div>
    </section><!-- End Gallery Section -->

 
      <!-- End Features Section -->
    </main>
    <style>
        .carousel-item.col-md-4{
            max-width:31% !important;
        }
        
        @media only screen and (max-width:800px){
            .carousel-item.col-md-4{
            max-width:100% !important;
        }
            #card-row{
                width:130% !important;
                margin-left:-15% !important;
                margin-right:15% !important;
            }
        }
    </style>
    <script>
      $(document).ready(function () {
        $("#myCarousel").on("slide.bs.carousel", function (e) {
          var $e = $(e.relatedTarget);
          var idx = $e.index();
          var itemsPerSlide = 3;
          var totalItems = $(".carousel-item").length;

          if (idx >= totalItems - (itemsPerSlide - 1)) {
            var it = itemsPerSlide - (totalItems - idx);
            for (var i = 0; i < it; i++) {
              // append slides to end
              if (e.direction == "left") {
                $(".carousel-item").eq(i).appendTo(".carousel-inner");
              } else {
                $(".carousel-item")
                  .eq(0)
                  .appendTo($(this).find(".carousel-inner"));
              }
            }
          }
        });
      });
    </script>
    <script src="{{ asset('frontend/assets1/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/assets1/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets1/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('frontend/assets1/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('frontend/assets1/vendor/venobox/venobox.min.js') }}"></script>
    <script src="{{ asset('frontend/assets1/vendor/waypoints/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/assets1/vendor/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('frontend/assets1/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/assets1/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/assets1/vendor/aos/aos.js') }}"></script>
    <!--App Carousel-->
     

  <!-- Vendor JS Files -->
  <script src="{{ asset('frontend/assets1/app-carousel/assets/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('frontend/assets1/app-carousel/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('frontend/assets1/app-carousel/assets/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('frontend/assets1/app-carousel/assets/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('frontend/assets1/app-carousel/assets/vendor/venobox/venobox.min.js') }}"></script>
  <script src="{{ asset('frontend/assets1/app-carousel/assets/vendor/aos/aos.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('frontend/assets1/app-carousel/assets/js/main.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('frontend/assets1/js/main.js') }}"></script>
    <!-- End #main -->
    @endsection
    
    
    