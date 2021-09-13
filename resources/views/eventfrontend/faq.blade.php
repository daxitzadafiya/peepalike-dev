@extends('eventfrontend.layout.newtheme-layout')
@section('title', 'FAQ')
@section('content')
<section class="parallax-section" data-scrollax-parent="true" id="sec1">
    <div class="bg par-elem "  data-bg="{{ asset('newtheme/images/all/12.jpg') }}" data-scrollax="properties: { translateY: '30%' }"></div>
    <div class="overlay"></div>
    <div class="container">
        <div class="section-title center-align">
            <h2><span>How It Works / FAQ</span></h2>
            <div class="breadcrumbs fl-wrap"><a href="#">Home</a><span>How It Works</span></div>
            <span class="section-separator"></span>
        </div>
    </div>
    <div class="header-sec-link">
        <div class="container"><a href="#sec2" class="custom-scroll-link">Let's Start</a></div>
    </div>
</section>
<section class="gray-bg" id="sec4">
    <div class="container">
        <div class="section-title">
            <h2> FAQ</h2>
            <div class="section-subtitle">popular questions</div>
            <span class="section-separator"></span>
            <p>Explore some of the best tips from around the city from our partners and friends.</p>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="accordion">
                    <a class="toggle act-accordion" href="#"> What is Peepalike and how will it change social meetups? <i class="fa fa-angle-down"></i></a>
                    <div class="accordion-inner visible">
                        <p>Peepalike is a free app; available on Android and iOS platforms, aimed at connecting people within the same localities that want to party or attend different events. It already has thousands of users in locations like Kenya and Uganda where it is used to link up people that want to meet new friends, grab a drink at festivals. 
						It also provides vital information on nightlife in the different areas in which it operates. It provides users with the opportunity to find like-minded friends. It is also the perfect tool for travelers that want a taste of the night life in new cities. 
						You have a lot of things in common with people from all over the world. </p>
                    </div>
					
                    <a class="toggle" href="#">Reasons why you should be using Peepalike <i class="fa fa-angle-down"></i></a>
                    <div class="accordion-inner">
                        <p>There are times when your favorite artist is in town but you miss the show because you do not have the company to accompany you. It could be because none of your friends are unavailable. Worse yet, they may not be into the same music as you. The research conducted to back  the launch of the Peepalike application ascertains that up to 80 percent of millenials have missed an event they really desired to attend during the previous year because they did not have the right company to accompany them.
Indeed, even within the Peepalike platform, people are increasingly using the Party Status function to serve this very purpose. This function emphasizes spontaneous meet ups, with statuses that disappear after several hours. Nevertheless, people post statuses for the same festivals and events everyday to connect with those that want to attend, weeks in advance.
</p>
                    </div>
                    
					
					<a class="toggle" href="#"> How can I add my event to Peepalike?<i class="fa fa-angle-down"></i></a>
                    <div class="accordion-inner">
                        <p>You can create event through the user panel, or contact admin for help through our contact center</p>
                    </div>
                    <a class="toggle" href="#">How Peepalike Works<i class="fa fa-angle-down"></i></a>
                    <div class="accordion-inner">
                        <p>In this context, the notion that group events and meet features were among the most requested within the Peepalike community over the past year is hardly surprising. People seem to exhibit the penchant for planning for festivals and other events and gather with their like-minded peers and attend jointly.</p>
                    </div>
                        <a class="toggle" href="#">Find Events in Nairobi <i class="fa fa-angle-down"></i></a>
                    <div class="accordion-inner">
                        <p>Use Peepalike to find <a href="">Events Near You</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection