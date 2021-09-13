@extends('eventfrontend.layout.newtheme-layout')
@section('title', 'About Us')
@section('content')
<!--section -->
<section class="parallax-section" data-scrollax-parent="true" id="sec1">
    <div class="bg par-elem "  data-bg="{{ asset('newtheme/images/sliderimage2.jpg') }}" data-scrollax="properties: { translateY: '30%' }"></div>
    <div class="overlay"></div>
    <div class="container">
        <div class="section-title center-align">
            <h2><span>About Our Company</span></h2>
            <div class="breadcrumbs fl-wrap"><a href="#">Home</a><span>About</span></div>
            <span class="section-separator"></span>
        </div>
    </div>
    <div class="header-sec-link">
        <div class="container"><a href="#sec2" class="custom-scroll-link">Let's Start</a></div>
    </div>
</section>
<!-- section end -->
<!--section -->
<div class="scroll-nav-wrapper fl-wrap">
    <div class="container">
        <nav class="scroll-nav scroll-init inline-scroll-container">
            <ul>
                <li><a class="act-scrlink" href="#sec1">Top</a></li>
                <li><a href="#sec2">About</a></li>
                <li><a href="#sec3">Facts</a></li>
                <li><a href="#sec4">Team</a></li>
                <li><a href="#sec5">Testimonials</a></li>
            </ul>
        </nav>
    </div>
</div>
<section  id="sec2">
    <div class="container">
        <div class="section-title">
            <h2> How We Work</h2>
            <div class="section-subtitle">popular questions</div>
            <span class="section-separator"></span>
            <p>Explore some of the best tips from around the city from our partners and friends.</p>
        </div>
        <!--about-wrap -->
        <div class="about-wrap">
            <div class="row">
                <div class="col-md-12">
                    <div class="list-single-main-item-title fl-wrap">
                        <h3>Our Awesome <span>Story</span></h3>
                        <h4>A little description about the company</h4>
                        <span class="section-separator fl-sec-sep"></span>
                    </div>
                    <p>With Peepalike, no one will ever have to miss out on a night because they didn't have company. It’s a situation we have all found ourselves in at some point in our lives. Sometimes it’s because our friends do not share the same music taste as us. In other cases, we may be in new cities or traveling alone. In others, you just don’t have people to accompany you to events like parties in your social circles. These situations are the reasons we decided to design and launch Peep alike; an application that helps you find spontaneous new party friends.
Peepalike is a new social meet up app that caters to those with  a soft spot for parties and other related events. As a social network, the Peepalike platform connects like-minded people for different events. It is different from other social applications in that it is not a dating app. Therefore, it eliminates the pressure users face to hook up, following a night out.
This app is based on a large community of users and events organizers. Many of the individual users have managed to meet up with like-minded people and became friends 
that party in different locations across the country and indeed the region. Peepalike is the perfect platform for both mainstream and low key parties and related events.

					
					
					</p>
                    <p>
                        Peepalike is a free app; available on Android and iOS platforms, aimed at connecting people within the same localities that want to party or attend different events. It already has thousands of users in locations like Kenya and Uganda where it is used to link up people that want to meet new friends, grab a drink at festivals. It also provides vital information on nightlife in the different areas in which it operates. It provides users with the opportunity to find like-minded friends. It is also the perfect tool for travelers that want a taste of the night life in new cities. You have a lot of things in common with people from all over the world. These people want to party with you. The only issue is that you merely haven’t met them yet. So without further ado, download the free application on your smartphone or tablet, or access the Peepalike platform through the website and join the largest and most interesting nightlife, party, and events communities around the world.
						Peepalike gives you the opportunity to find people(travelers, locals, or expats) nearby with the same interests that want to party or attend events.
						Notify others that you are available for activities like clubbing or grabbing a drink, among others.
						Join or organize events or parties.
					<li>	Meet up. </li>
						<li> Party. </li>
						<li> Chat directly. </li>

                    </p>
                    <a href="#sec3" class="btn transparent-btn float-btn custom-scroll-link">Our Team <i class="fa fa-users"></i></a>
                </div>
            </div>
        </div>
        <!-- about-wrap end  -->
        <span class="fw-separator"></span>
        <!-- features-box-container -->
        <div class="features-box-container fl-wrap row">
            <!--features-box -->
            <div class="features-box col-md-4">
                <div class="time-line-icon">
                    <i class="fa fa-medkit"></i>
                </div>
                <h3>Web Panel</h3>
                <p>Available in All Web Platforms </p>
            </div>
            <!-- features-box end  -->
            <!--features-box -->
            <div class="features-box col-md-4">
                <div class="time-line-icon">
                    <i class="fa fa-cogs"></i>
                </div>
                <h3>Android</h3>
                <p>Available in Playstore </p>
            </div>
            <!-- features-box end  -->
            <!--features-box -->
            <div class="features-box col-md-4">
                <div class="time-line-icon">
                    <i class="fa fa-television"></i>
                </div>
                <h3>App Store</h3>
                <p>Download the Latest Version </p>
            </div>
            <!-- features-box end  -->
        </div>
        <!-- features-box-container end  -->
    </div>
</section>
<!-- section end -->
<!--section -->
<section id="sec4">
    <div class="container">
        <div class="section-title">
            <h2>Download Now</h2>
            <div class="section-subtitle"></div>
            <span class="section-separator"></span>
            <p>With Peepalike, there's less chance of missing out on any</p>
        </div>
        <div class="team-holder section-team fl-wrap">
            <!-- team-item -->
     
            <!-- team-item  end-->
            <!-- team-item -->
     
            <!-- team-item end  -->
            <!-- team-item -->
       
            <!-- team-item end  -->
        </div>
    </div>
</section>
<!-- section end -->
<div class="limit-box"></div>
@endsection