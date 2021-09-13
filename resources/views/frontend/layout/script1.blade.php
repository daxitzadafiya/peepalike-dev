<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5f148d97a45e787d128bbb5e/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
<script src="{{ asset('frontend/assets/js/jquery.min.js') }}" type="text/javascript"></script>
<!-- Default js-->
<script>
    var timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
    document.cookie = "vUserDeviceTimeZone="+timezone;
</script>
<script type="text/javascript" src="{{asset('frontend/assets/js/amazingcarousel.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/assets/js/initcarousel.js')}}"></script>
<!-- js -->
<script type="text/javascript" src="{{asset('frontend/assets/js/jquery-1.11.0.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/assets/js/waypoints.min.js')}}"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false&amp;libraries=places&amp;language=en&amp;key=AIzaSyBjA92EIcwcbIYVa78x-yJK9gQNnzF6rXI"></script>
<script type="text/javascript">//<![CDATA[
    $(function(){
        function onScrollInit( items, trigger ) {
            items.each( function() {
                var osElement = $(this),
                    osAnimationClass = osElement.attr('data-os-animation'),
                    osAnimationDelay = osElement.attr('data-os-animation-delay');

                osElement.css({
                    '-webkit-animation-delay':  osAnimationDelay,
                    '-moz-animation-delay':     osAnimationDelay,
                    'animation-delay':          osAnimationDelay
                });
                var osTrigger = ( trigger ) ? trigger : osElement;

                osTrigger.waypoint(function() {
                    osElement.addClass('animated').addClass(osAnimationClass);
                },{
                    triggerOnce: true,
                    offset: '100%'
                });
            });
        }
        onScrollInit( $('.os-animation') );
        onScrollInit( $('.staggered-animation'), $('.staggered-animation-container') );
    });//]]>
</script>
<script>
    // var map;
    // var geocoder;
    // var autocomplete_from;
    // var autocomplete_to;
    // function initialize() {
    //     geocoder = new google.maps.Geocoder();
    //     var mapOptions = {
    //         zoom: 4,
    //         //center: new google.maps.LatLng('20.1849963', '64.4125062')
    //     };
    //     map = new google.maps.Map(document.getElementById('map-canvas'),
    //         mapOptions);
    //
    //     var location = 'http://cubetaxiplusbeta.bbcsproducts.com/Page-Not-Found';
    //     geocoder = new google.maps.Geocoder();
    //     geocoder.geocode( { 'address': location }, function(results, status) {
    //         if (status == google.maps.GeocoderStatus.OK) {
    //             //console.log(results);
    //             map.setCenter(results[0].geometry.location);
    //         } else {
    //             alert("Could not find location: " + location);
    //         }
    //     });
    // }

    $(document).ready(function () {
        $("#setEstimate_figure").hide();
        google.maps.event.addDomListener(window, 'load', initialize);
    });


    $(function () {

        var from = document.getElementById('from');
        autocomplete_from = new google.maps.places.Autocomplete(from);
        google.maps.event.addListener(autocomplete_from, 'place_changed', function() {
            var place = autocomplete_from.getPlace();
            $("#from_lat_long").val(place.geometry.location);
            $("#from_lat").val(place.geometry.location.lat());
            $("#from_long").val(place.geometry.location.lng());
            go_for_action();
        });

        var to = document.getElementById('to');
        autocomplete_to = new google.maps.places.Autocomplete(to);
        google.maps.event.addListener(autocomplete_to, 'place_changed', function() {
            var place = autocomplete_to.getPlace();
            $("#to_lat_long").val(place.geometry.location);
            $("#to_lat").val(place.geometry.location.lat());
            $("#to_long").val(place.geometry.location.lng());
            go_for_action();
        });

        function go_for_action() {
            if ($("#from").val() != '' && $("#to").val() == '') {
                show_location($("#from_lat").val(),$("#from_long").val());
            }
            if ($("#to").val() != '' && $("#from").val() == '') {
                show_location($("#to_lat").val(),$("#to_long").val());
            }
            if ($("#from").val() != '' && $("#to").val() != '') {
                from_to($("#from").val(), $("#to").val());
            }
        }
    });
</script>
<script type="text/javascript" src="{{ asset('frontend/assets/js/gmap3.js') }}"></script>
<script type="text/javascript">
    var chk_route;
    function show_location(set,dest) {
        //alert("show_location");
        clearThat();
        $('#map-canvas').gmap3({
            marker: {
                latLng:[set,dest]
            },
            map: {
                options: {
                    zoom: 16
                }
            }
        });
    }

    function clearThat() {
        var opts = {};
        opts.name = ["marker", "directionsrenderer"];
        opts.first = true;
        $('#map-canvas').gmap3({clear: opts});
    }

    function from_to(from, to) {

        clearThat();
        if (from == '')
            from = $('#from').val();
        if (to == '')
            to = $('#to').val();
        if(from != '' && to != '') {

            var fromLatlongs = $("#from_lat").val()+", "+$("#from_long").val();
            var toLatlongs = $("#to_lat").val()+", "+$("#to_long").val();

            $("#map-canvas").gmap3({
                getroute: {
                    options: {
                        origin: fromLatlongs,
                        destination: toLatlongs,
                        travelMode: google.maps.DirectionsTravelMode.DRIVING
                    },
                    callback: function (results, status) {
                        chk_route = status;
                        if (!results)
                            return;
                        $(this).gmap3({
                            map: {
                                options: {
                                    zoom: 8,
                                    //center: [51.511214, -0.119824]
                                    center: [58.0000, 20.0000]
                                }
                            },
                            directionsrenderer: {
                                options: {
                                    directions: results
                                }
                            }
                        });
                    }
                }
            });

            $("#map-canvas").gmap3({
                getdistance: {
                    options: {
                        origins: fromLatlongs,
                        destinations: toLatlongs,
                        travelMode: google.maps.TravelMode.DRIVING
                    },
                    callback: function (results, status) {
                        $('.get-fare-estimation-left').addClass('new-dd001');
                        var html = "";
                        if (results) {
                            for (var i = 0; i < results.rows.length; i++) {
                                var elements = results.rows[i].elements;
                                for (var j = 0; j < elements.length; j++) {
                                    switch (elements[j].status) {
                                        case "OK":
                                            html += elements[j].distance.text + " (" + elements[j].duration.text + ")<br />";
                                            document.getElementById("distance").value = elements[j].distance.value;
                                            document.getElementById("duration").value = elements[j].duration.value;
                                            var dist_fare = parseInt(elements[j].distance.value, 10) / parseInt(1000, 10);
                                            $('#dist_fare').text(Math.round(dist_fare));
                                            var time_fare = parseInt(elements[j].duration.value, 10) / parseInt(60, 10);
                                            $('#time_fare').text(Math.round(time_fare));
                                            var vehicleId = $('#iVehicleTypeId').val();
                                            var fromLoc = $('#from').val();
                                            $.ajax({
                                                type: "POST",
                                                url: 'ajax_find_estimate.php',
                                                data: {dist_fare: dist_fare,time_fare: time_fare, fromLoc: fromLoc },
                                                dataType: 'html',
                                                success: function (dataHtml)
                                                {
                                                    $("#setEstimate_figure").show();
                                                    $("#setEstimate_figure").html(dataHtml);
                                                }
                                            });
                                            document.getElementById("location_found").value = 1;
                                            break;
                                        case "NOT_FOUND":
                                            document.getElementById("location_found").value = 0;
                                            break;
                                        case "ZERO_RESULTS":
                                            document.getElementById("location_found").value = 0;
                                            break;
                                    }
                                }
                            }
                        } else {
                            html = "error";
                        }
                        $("#results").html(html);
                    }
                }
            });
        }
    }
</script>
<script>
    // function change_lang(lang){
    //     document.location='common415a.html?lang='+lang;
    // }
</script>


<script type="text/javascript">
    $(document).ready(function(){
        $(".custom-select-new1").each(function(){
            var selectedOption = $(this).find(":selected").text();
            $(this).wrap("<em class='select-wrapper'></em>");
            $(this).after("<em class='holder'>"+selectedOption+"</em>");
        });
        $(".custom-select-new1").change(function(){
            var selectedOption = $(this).find(":selected").text();
            $(this).next(".holder").text(selectedOption);
        });
        $("#lang_box").hide();
        $("#lang_open").click(function(){
            $("#lang_box").slideToggle();
        });

        $('html').click(function(e) {
            $('#lang_box').hide();
        });

        $('#lang_open').click(function(e){
            e.stopPropagation();
        });

    })
</script>
<!-- Custome JS -->
<script src="{{asset('frontend/assets/js/bootbox.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/magic.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".custom-select-new").each(function(){
            $(this).wrap("<em class='select-wrapper'></em>");
            $(this).after("<em class='holder'></em>");
        });
        $(".custom-select-new").change(function(){
            var selectedOption = $(this).find(":selected").text();
            $(this).next(".holder").text(selectedOption);
        }).trigger('change');

        $(".label-i").on('click',function(e) {
            var lang_id = $(this).data('id');
            var from = $(this).data('value');
            $.ajax({
                type: "POST",
                url: 'language_popup.php',
                data: 'lang_id=' + lang_id + '&from='+from,
                success: function (dataHtml)
                {
                    $("#lang_popup").html(dataHtml);
                    $("#myModalHorizontal").modal('show');
                },
                error: function(dataHtml){

                }
            });
            e.stopPropagation();
            return false;
        });
    });

    // function updateLanguage(){
    // 	var formdata = $("#_languages_form").serialize();
    // 	$.ajax({
    // 		type: "POST",
    // 		url: 'language_save.php',
    // 		data: formdata,
    // 		success: function (dataHtml)
    // 		{
    // 			location.reload();
    // 		},
    // 		error: function(dataHtml){

    // 		}
    // 	});
    // }

</script>
