@extends('frontend.layout1.app')

@section('content')
    <link
      href="{{ asset('frontend/assets1/vendor/bootstrap/css/bootstrap.min.css') }}"
      rel="stylesheet"
    />
  <!--  <link href="{{ asset('frontend/assets1/vendor/animate.min.css') }}" rel="stylesheet" />-->
  <!--  <link href="{{ asset('frontend/assets1/vendor/icofont/icofont.min.css') }}" rel="stylesheet" />-->
  <!--  <link href="{{ asset('frontend/assets1/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet" />-->
  <!--  <link href="{{ asset('frontend/assets1/vendor/venobox/venobox.css') }}" rel="stylesheet" />-->
  <!--  <link href="{{ asset('frontend/assets1/owl.carousel/assets/owl.carousel.css') }}" rel="stylesheet" />-->
  <!--  <link href="{{ asset('frontend/assets1/vendor/aos/aos.css') }}" rel="stylesheet" />-->
    <!--App Carousel-->
  <!--  <link href="{{ asset('frontend/assets1/app-carousel/assets/vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">-->
  <!--<link href="{{ asset('frontend/assets1/app-carousel/assets/vendor/venobox/venobox.css') }}" rel="stylesheet">-->
  <!--<link href="{{ asset('frontend/assets1/app-carousel/assets/vendor/aos/aos.css') }}" rel="stylesheet">-->

  <!-- Template Main CSS File -->
  <link href="{{ asset('frontend/assets1/app-carousel/assets/css/style.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('frontend/assets1/extra/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets1/extra/css/bootstrap-theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets1/extra/css/fontAwesome.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets1/extra/css/hero-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets1/extra/css/owl-carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets1/extra/css/style.css') }}">

    <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <script src="{{ asset('frontend/assets1/extra/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js') }}"></script>
    
    <section class="banner banner-secondary" id="top" style="background:linear-gradient(90deg,#0D324D,#EEC0C6);">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="banner-caption">
                        <div class="line-dec"></div>
                        <h2>{{ $job[0]->post_title }}</h2>
                        <!--<h4><i class="fa fa-briefcase"></i> </h4>-->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <main>
        <section class="featured-places">
            <div class="container">
               <div class="row">
                  <div class="col-lg-3 col-md-3 col-xs-12">
                    <div>
                      <img src="{{ $company[0]->logo_url }}" alt="" class="img-responsive wc-image">
                    </div>
                    <br>
                  </div>

                  <div class="col-lg-9 col-md-9 col-xs-12">
                      @if($job[0]->stipend)
                    <h2 style="color:#1e4356"><i class="fa fa-money" style="color:#1e4356"></i> $  {{ $job[0]->stipend }}</h2>
                    @else
                    <h3 style="color:#1e4356"><i class="fa fa-money" style="color:#1e4356"></i> Not disclosed</h3>
                    @endif
                    <p class="lead">
                     <i class="fa fa-map-marker"></i> {{ $company[0]->location }} &nbsp;&nbsp;
                     <i class="fa fa-calendar"></i> {{ $job[0]->date_created }} &nbsp;&nbsp;
                     <!--<i class="fa fa-file"></i> Contract-->
                    </p>

                    <div>
                          <a href="{{ $company[0]->web_link }}" target="_blank" style="text-decoration:none;background: #1e4356;color:#fff;padding:10px;">Apply for this job</a>
                      </div><br>
                  </div>
                </div>

                <div class="accordions">
                    <ul class="accordion">
                        <li>
                            <a class="accordion-trigger">Job Description</a>
                            
                            <div class="accordion-content">
                                <p>{{ $job[0]->post_description }}
                                </p>

                                <!--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem voluptatem vero culpa rerum similique labore, nisi minus voluptatum numquam fugiat. <br><br>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Placeat fugit sint reiciendis quas temporibus quam maxime nulla vitae consectetur perferendis, fugiat assumenda ex dicta molestias soluta est quo totam cum?</p>-->
                            </div>
                        </li>
                        <li>
                            <a class="accordion-trigger">About {{ $company[0]->name }}</a>
                            <div class="accordion-content">
                              <p class="lead"> <i class="fa fa-map-marker"></i> {{ $company[0]->location }} </p>

                             <p>
                                 {{ $company[0]->meta }}
                             </p>
                            </div>
                        </li>
                        <li>
                            <a class="accordion-trigger">Contact Details</a>

                            <div class="accordion-content">
                              <p>
                                  <span>Name</span>

                                  <br>

                                  <strong>{{ $company[0]->manager }}</strong>

                              </p>

                              <p>
                                  <span>Phone</span>

                                  <br>
                                  
                                  <strong>
                                    <a href="{{ $company[0]->contact }}">{{ $company[0]->contact }}</a>
                                  </strong>
                              </p>

                              <p>
                                <span>Email</span>

                                <br>
                                
                                <strong>
                                  <a href="mailto:{{ $company[0]->email }}">{{ $company[0]->email }}</a>
                                </strong>
                              </p>

                              <p>
                                <span>Website</span>

                                <br>
                                
                                <strong>
                                  <a href="{{ $company[0]->web_link }}">{{ $company[0]->web_link }}/</a>
                                </strong>
                              </p>
                            </div>
                        </li>
                    </ul> <!-- / accordion -->
                </div>
            </div>
        </section>
    </main>

    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" type="text/javascript"></script>
    <script>
        window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')
    </script>

    <script src="{{ asset('frontend/assets1/extra/js/vendor/bootstrap.min.js') }}"></script>

    <script src="{{ asset('frontend/assets1/extra/js/datepicker.js') }}"></script>
    <script src="{{ asset('frontend/assets1/extra/js/plugins.js') }}"></script>
    <script src="{{ asset('frontend/assets1/extra/js/main.js') }}"></script>
@endsection