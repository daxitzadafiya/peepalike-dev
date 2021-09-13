@extends('eventusers.layout.app')
@section('style')
  <link rel="stylesheet" href="{{ asset('eventadmin/summernote/dist/summernote.css') }}">
@endsection
@section('content')
    <!-- Header -->
    <div class="header pb-6 d-flex align-items-center" style="min-height: 50px; margin-bottom: 10px;">
    </div>
<!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-12 order-xl-1">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Edit Event </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form action="{{ url('/eventuser/updateEvent') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <h6 class="heading-small text-muted mb-4">Event Information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Event Name</label>
                        <input type="text" id="event_name" name="event_name" class="form-control" placeholder="Event Name" required="" value="{{ $UserEvents->event_name }}">
                        <input type="hidden" id="id" name="id" value="{{ $UserEvents->id }}" >
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Vanue Name</label>
                        <input type="text" id="vanue_name" name="vanue_name" class="form-control" placeholder="Vanue name" required="" value="{{ $UserEvents->event_name }}">
                      </div>
                    </div>
                    <div class="col-lg-2">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Event Image</label>
                        <input type="file" id="image" name="image" class="form-control" placeholder="Event Image" accept="image/*">
                      </div>
                    </div>
                    <div class="col-lg-2">
                      <div class="form-group">
                        <img src="@if($UserEvents->event_image != '') {{ url('/').'/images/'.$UserEvents->event_image }} @else {{ 'http://placehold.it/200x200' }}  @endif " alt="profile pic" style="width: 100px; height: 100px;">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Event Location</label>
                        <select class="form-control" name="event_location" id="event_location" required>
                            <option value="venue" @if($UserEvents->event_location == 'venue') {{ 'selected' }} @endif >Venue</option>
                            <option value="online" @if($UserEvents->event_location == 'online') {{ 'selected' }} @endif >Online event</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Event Type</label>
                        <select class="form-control" name="event_type" id="event_type" required>
                            <option value="get ticket" @if($UserEvents->event_type == 'get ticket') {{ 'selected' }} @endif >Get Ticket</option>
                            <option value="free" @if($UserEvents->event_type == 'free') {{ 'selected' }} @endif >Free</option>
                        </select>
                      </div>
                    </div>




                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Is trending event?</label>
                        <select class="form-control" name="trending_event" id="trending_event" required>
                            <option value="no" @if($UserEvents->is_trending_event == 'no') {{ 'selected' }} @endif >No</option>
                            <option value="yes" @if($UserEvents->is_trending_event == 'yes') {{ 'selected' }} @endif >Yes</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4 showaddress" />
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4 showaddress">Street Address</h6>
                <div class="pl-lg-4 showaddress">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-address">Address</label>
                        <input id="address" name="address" class="form-control" placeholder="Home Address"  type="text" required="" value="{{ $UserEvents->address }}">
                        <input type="hidden" id="latitude" name="latitude" value="{{ $UserEvents->latitude }}" >
                        <input type="hidden" id="longitude" name="longitude" value="{{ $UserEvents->longitude }}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label class="form-control-label" for="input-city">City</label>
                        <input id="city" name="city" class="form-control" placeholder="Home Address"  type="text" required="" value="{{ $UserEvents->city }}">
                        <!-- <select class="form-control" name="city" id="city" required>
                            <option>Select City</option>
                        </select> -->
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label class="form-control-label" for="input-city">State</label>
                        <input id="state" name="state" class="form-control" placeholder="Home Address"  type="text" required="" value="{{ $UserEvents->state }}">
                        <!-- <select class="form-control" name="state" id="state" required>
                            <option >Select State</option>

                        </select> -->
                      </div>
                    </div>

                    <div class="col-lg-3">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">Country</label>
                        <input id="country" name="country" class="form-control" placeholder="Home Address"  type="text" required="" value="{{ $UserEvents->country }}">
                        <!-- <select class="form-control" name="country" id="country" required="">
                            <option>Select Country</option>
                            @foreach($countries as $country)
                                <option value="{{$country->name}}" data-id="{{$country->id}}">{{$country->name}}</option>
                            @endforeach
                        </select> -->
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">Postal code</label>
                        <input type="number" id="postal_code" name="postal_code" class="form-control" placeholder="Postal code" required="" value="{{ $UserEvents->postal_code }}">
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Date & Time</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-city">Start Date</label>
                        <input type="date" id="event_start_date" name="event_start_date" class="form-control" placeholder="Start Date" required="" value="{{ $UserEvents->event_start_date }}">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-city">Start Time</label>
                        <input type="time" id="event_start_time" name="event_start_time" class="form-control" placeholder="Start Time" required="" value="{{ $UserEvents->event_start_time }}">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">End Date</label>
                        <input type="date" id="event_end_date" name="event_end_date" class="form-control" placeholder="End Date" required="" value="{{ $UserEvents->event_end_date }}">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">End Time</label>
                        <input type="time" id="event_end_time" name="event_end_time" class="form-control" placeholder="End Time" required="" value="{{ $UserEvents->event_end_time }}">
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                <!-- Description -->
                <h6 class="heading-small text-muted mb-4">About Event</h6>
                <div class="pl-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Description</label>
                    <textarea rows="4" class="form-control" placeholder="A few words about you ..." id="description" name="description" required="">{{ $UserEvents->description }}</textarea>
                  </div>
                </div>
                <button class="btn btn-primary" type="submit">Submit form</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
@section('script')
  <script src="{{ asset('eventadmin/summernote.bundle.js') }}"></script>
  <script src="{{ asset('eventadmin/summernote.js') }}"></script>
  <script src="{{ asset('eventadmin/jquery.validate.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAL6Dg0qk25EiU3vstUKfnwNOEhE-G3vAM&libraries=places&callback=initAutocomplete" async defer></script>
  <script type="text/javascript">
   $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


   var placeSearch, autocomplete, address_components;

    function initAutocomplete() {
        // Create the autocomplete object, restricting the search predictions to
        // geographical location types.
        //alert(document.getElementById('autocomplete'));
        autocomplete = new google.maps.places.Autocomplete(
            document.getElementById('address'));

        // Avoid paying for data that you don't need by restricting the set of
        // place fields that are returned to just the address components.
        //autocomplete.setFields('address_components');

        // When the user selects an address from the drop-down, populate the
        // address fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
    }

    function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        $('#latitude').val(place.geometry.location.lat());
        $('#longitude').val(place.geometry.location.lng());
        //$('#state').val(place.address_components.location.lng());
        //$('#city').val(place.geometry.location.lng());

        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            console.log(addressType);
            if (addressType === 'country'){
                $('#country').val(place.address_components[i].long_name);
                $('#country').click();

            } else if(addressType === 'administrative_area_level_1'){
                $('#state').val(place.address_components[i].long_name);

            } else if(addressType === 'locality' || addressType == 'administrative_area_level_2') {
                $('#city').val(place.address_components[i].long_name);
            } else if(addressType === 'postal_code'){

                $('#postal_code').val(place.address_components[i].long_name);

            } else {

            }
        }
    }
    $('#event_location').click(function(){
        var event_location=$('#event_location').val();
        if(event_location == 'online'){
          $('.showaddress').hide();
        }else{
          $('.showaddress').show();
        }
    });
  </script>
@endsection
