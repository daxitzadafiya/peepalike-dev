@extends('eventfrontend.layout.newtheme-layout')
@section('title', 'FAQ')
@section('content')
<section class="parallax-section" data-scrollax-parent="true">
    <div class="bg par-elem "  data-bg="{{ asset('newtheme/images/all/2.jpg') }}" data-scrollax="properties: { translateY: '30%' }"></div>
    <div class="overlay"></div>
    <div class="bubble-bg"></div>
    <div class="container">
        <div class="section-title center-align">
            <h2><span>Our Contacts</span></h2>
            <div class="breadcrumbs fl-wrap"><a href="#">Home</a> <span>Contacts</span></div>
            <span class="section-separator"></span>
        </div>
    </div>
    <div class="header-sec-link">
        <div class="container"><a href="#sec1" class="custom-scroll-link">Let's Start</a></div>
    </div>
</section>
<!-- section end -->
<!--section -->  
<section id="sec1">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="list-single-main-item fl-wrap">
                    <div class="list-single-main-item-title fl-wrap">
                        <h3>Contact <span>Details </span></h3>
                    </div>
                    <div class="list-single-main-media fl-wrap">
                        <img src="{{ asset('newtheme/images/all/12.jpg') }}" class="respimg" alt="">
                    </div>
                    <p>The Peepalike app has a join the party feature, which allows users to add their events from Facebook for which they are looking for party crews to notify them that they are available to attend together.
					The platform also allows users to browse the events others are attending in nearby locations and allows them to join.



</p>
<p>The beta test for this feature revealed that people from different regions have a high likelihood of meeting up for different types of events. 
This aspect implies that the efforts of our team to establish and sustain a community of open minded party and events people has been a huge success. We are based in Nairobi but operate in a wide range of other countries across Africa and beyond.
</p>
                    <div class="list-author-widget-contacts">
                   
                    </div>
                    <div class="list-widget-social">
                        <ul>
                            <li><a href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fa fa-vk"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fa fa-whatsapp"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="list-single-main-wrapper fl-wrap">
                    <div class="list-single-main-item-title fl-wrap">
                        <h3>Our Location</h3>
                    </div>
                    <div class="map-container">
                        <div id="singleMap"></div>
                    </div>
                    <div class="list-single-main-item-title fl-wrap">
                        <h3>Get In Touch</h3>
                    </div>
                    <div id="contact-form">
                        <div id="message"></div>
                        <form  class="custom-form" action="#" name="contactform" id="contactform">
                            <fieldset>
                                <label><i class="fa fa-user-o"></i></label>
                                <input type="text" name="name" id="name" placeholder="Your Name *" value=""/>
                                <div class="clearfix"></div>
                                <label><i class="fa fa-envelope-o"></i>  </label>
                                <input type="text"  name="email" id="email" placeholder="Email Address*" value=""/>
                                <textarea name="comments"  id="comments" cols="40" rows="3" placeholder="Your Message:"></textarea>
                            </fieldset>
                            <button class="btn  big-btn  color-bg flat-btn" id="submit">Send<i class="fa fa-angle-right"></i></button>
                        </form>
                    </div>
                    <!-- contact form  end--> 
                </div>
            </div>
        </div>
    </div>
</section>
<!-- section end -->
<div class="limit-box fl-wrap"></div>
@endsection
@section('script')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAL6Dg0qk25EiU3vstUKfnwNOEhE-G3vAM&callback=initMap&libraries=&v=weekly" async></script>
<script>
    function initMap() {
        // The location of Uluru
        const uluru = { lat: 40.7427837, lng: -73.11445617675781 };
        // The map, centered at Uluru
        const map = new google.maps.Map(document.getElementById("singleMap"), {
            zoom: 12,
            center: uluru,
        });
        // The marker, positioned at Uluru
        const marker = new google.maps.Marker({
            position: uluru,
            map: map,
        });
    }
</script>
@endsection