@extends('user.layout.app')
@section('style')
  <link rel="stylesheet" href="{{ asset('eventadmin/summernote/dist/summernote.css') }}">
@endsection
@section('content')
    {{-- <!-- Header -->
    <div class="header pb-6 d-flex align-items-center" style="min-height: 50px; margin-bottom: 10px;">

    </div> --}}
<!-- Page content -->
    <div class="header pb-6 mt--6 event-content">
      <div class="row">
        <div class="col-xl-12 order-xl-1 event-heading">
          <h3 class="">Edit Event </h3>
        </div>
        <div class="col-xl-12 order-xl-1 event-form-wrapper">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="event-form-option">
                  <ul>
                    <li><a class="btn basic active" data-res="basic">Basic</a></li>
                    <li><a class="btn address" data-res="address">Address</a></li>
                    <li><a class="btn dt" data-res="dt">Date & Time</a></li>
                    <li><a class="btn about" data-res="about">About</a></li>
                 
                    <li><a class="btn profile" data-res="profile">Profile</a></li>
                    <li><a class="btn social" data-res="social">Social</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="card-body event-content-wrapper">
              <form action="{{ url('user/updateEvent') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="pl-lg-4 basic">
                  <h6 class="heading-small text-muted mb-4">Event Information</h6>
                  <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-3 ">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Event Name</label>
                      </div>
                    </div>
                    <div class="col-lg-5 col-md-9 col-sm-9 ">
                      <div class="form-group">
                        <input type="text" id="event_name" name="event_name" class="form-control" placeholder="Event Name" required="" value="{{ $UserEvents->event_name }}">
                        <input type="hidden" id="id" name="id" value="{{ $UserEvents->id }}" >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-3 ">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Vanue Name</label>
                      </div>
                    </div>
                    <div class="col-lg-5 col-md-9 col-sm-9 ">
                      <div class="form-group">
                        <input type="text" id="vanue_name" name="vanue_name" class="form-control" placeholder="Vanue name" required="" value="{{ $UserEvents->event_name }}">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-3 ">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Job</label>
                      </div>
                    </div>
                    <div class="col-lg-5 col-md-9 col-sm-9 ">
                      <div class="form-group">
                        <select class="form-control" name="event_job" required>
                          <option value=" @if($UserEvents->job == 'For CEO') {{ 'selected' }} @endif ">For CEO</option>
                          <option value=" @if($UserEvents->job == 'For Individual') {{ 'selected' }} @endif ">For Individual</option>
                          <option value=" @if($UserEvents->job == 'For Manager') {{ 'selected' }} @endif ">For Manager</option>
                      </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-3 ">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Event Image</label>
                      </div>
                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-6 ">
                      <div class="form-group">
                        <input type="file" id="event_image" name="event_image" class="form-control" placeholder="Event Image" accept="image/*">
                      </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-3">
                      <div class="form-group">
                        <img src="@if($UserEvents->event_image != '') {{ url('/').'/images/'.$UserEvents->event_image }} @else {{ 'http://placehold.it/200x200' }}  @endif " alt="profile pic" style="width: 100px; height: 100px;">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-3 ">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Event Location</label>
                      </div>
                    </div>
                    <div class="col-lg-5 col-md-9 col-sm-9 ">
                      <div class="form-group">
                        <select class="form-control" name="event_location" id="event_location" required>
                          <option value="venue" @if($UserEvents->event_location == 'venue') {{ 'selected' }} @endif >Venue</option>
                          <option value="online" @if($UserEvents->event_location == 'online') {{ 'selected' }} @endif >Online event</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-3 ">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Event category</label>
                      </div>
                    </div>
                    <div class="col-lg-5 col-md-9 col-sm-9 ">
                      <div class="form-group">
                        <select class="form-control" name="category" id="event_type" required>
                 
                         @foreach ($category as $item1)
                            @if($item1->ecid == $UserEvents->ecid) 
                           <option value="{{ $item1->ecid }}" selected >{{$item1->cname}}</option>
                            @endif
                         @endforeach
                          @foreach( $category as $item)
                            <option value="{{ $item->ecid }}" >{{ $item->cname }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-3 ">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Event Type</label>
                      </div>
                    </div>
                    <div class="col-lg-5 col-md-9 col-sm-9 ">
                      <div class="form-group">
                        <select class="form-control" name="event_type" id="event_type" required>
                          <option value="get ticket" @if($UserEvents->event_type == 'get ticket') {{ 'selected' }} @endif >Get Ticket</option>
                          <option value="free" @if($UserEvents->event_type == 'free') {{ 'selected' }} @endif >Free</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-3 ">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Is trending event?</label>
                      </div>
                    </div>
                    <div class="col-lg-5 col-md-9 col-sm-9 ">
                      <div class="form-group">
                        <select class="form-control" name="trending_event" id="trending_event" required>
                          <option value="no" @if($UserEvents->is_trending_event == 'no') {{ 'selected' }} @endif >No</option>
                          <option value="yes" @if($UserEvents->is_trending_event == 'yes') {{ 'selected' }} @endif >Yes</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Address -->
                <div class="pl-lg-4 address showaddress" style="display: none">
                  <h6 class="heading-small text-muted mb-4 showaddress">Street Address</h6>
                  <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-3 ">
                      <div class="form-group">
                        <label class="form-control-label" for="input-address">Address</label>
                      </div>
                    </div>
                    <div class="col-lg-5 col-md-9 col-sm-9 ">
                      <div class="form-group">
                        <input id="address" name="address" class="form-control" placeholder="Home Address"  type="text" required="" value="{{ $UserEvents->address }}">
                        <input type="hidden" id="latitude" name="latitude" value="{{ $UserEvents->latitude }}" >
                        <input type="hidden" id="longitude" name="longitude" value="{{ $UserEvents->longitude }}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-3 ">
                      <div class="form-group">
                        <label class="form-control-label" for="input-address">Space</label>
                      </div>
                    </div>
                    <div class="col-lg-5 col-md-9 col-sm-9 ">
                      <div class="form-group">
                        <select class="form-control" name="space" id="trending_event" required>
                          <option value=" @if($UserEvents->space == 'In room') {{ 'selected' }} @endif">In room</option>
                          <option value="@if($UserEvents->space == 'Out Side') {{ 'selected' }} @endif">Out Side</option>
                      </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-3 ">
                      <div class="form-group">
                        <label class="form-control-label" for="input-city">City</label>
                      </div>
                    </div>
                    <div class="col-lg-5 col-md-9 col-sm-9 ">
                      <div class="form-group">
                        <input id="city" name="city" class="form-control" placeholder="City Address"  type="text" required=""  value="{{ $UserEvents->city }}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-3 ">
                      <div class="form-group">
                        <label class="form-control-label" for="input-city">State</label>
                      </div>
                    </div>
                    <div class="col-lg-5 col-md-9 col-sm-9 ">
                      <div class="form-group">
                        <input id="state" name="state" class="form-control" placeholder="State Address"  type="text"  required="" value="{{ $UserEvents->state }}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-3 ">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">Country</label>
                      </div>
                    </div>
                    <div class="col-lg-5 col-md-9 col-sm-9 ">
                      <div class="form-group">
                        <input id="country" name="country" class="form-control" placeholder="Country Address"  type="text" required="" value="{{ $UserEvents->country }}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-3 ">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">Postal code</label>
                      </div>
                    </div>
                    <div class="col-lg-5 col-md-9 col-sm-9 ">
                      <div class="form-group">
                        <input type="number" id="postal_code" name="postal_code" class="form-control" placeholder="Postal code" required="" value="{{ $UserEvents->postal_code }}">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Address -->
                <div class="pl-lg-4 dt" style="display: none">
                  <h6 class="heading-small text-muted mb-4">Date & Time</h6>
                  <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-3 ">
                      <div class="form-group">
                        <label class="form-control-label" for="input-city">Start Date</label>
                      </div>
                    </div>
                    <div class="col-lg-5 col-md-9 col-sm-9 ">
                      <div class="form-group">
                        <input type="date" id="event_start_date" name="event_start_date" class="form-control" placeholder="Start Date" required="" value="{{ $UserEvents->event_start_date }}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-3 ">
                      <div class="form-group">
                        <label class="form-control-label" for="input-city">Start Time</label>
                      </div>
                    </div>
                    <div class="col-lg-5 col-md-9 col-sm-9 ">
                      <div class="form-group">
                        <input type="time" id="event_start_time" name="event_start_time" class="form-control" placeholder="Start Time" required="" value="{{ $UserEvents->event_start_time }}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-3 ">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">End Date</label>
                      </div>
                    </div>
                    <div class="col-lg-5 col-md-9 col-sm-9 ">
                      <div class="form-group">
                        <input type="date" id="event_end_date" name="event_end_date" class="form-control" placeholder="End Date" required="" value="{{ $UserEvents->event_end_date }}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-3 ">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">End Time</label>
                      </div>
                    </div>
                    <div class="col-lg-5 col-md-9 col-sm-9 ">
                      <div class="form-group">
                        <input type="time" id="event_end_time" name="event_end_time" class="form-control" placeholder="End Time" required="" value="{{ $UserEvents->event_end_time }}">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Description -->
                <div class="pl-lg-4 about" style="display: none">
                  <h6 class="heading-small text-muted mb-4">About Event</h6>
                  <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-3 ">
                      <div class="form-group">
                        <label class="form-control-label">Description</label>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 ">
                      <div class="form-group">
                        <textarea type="text" id="content_editor" class="form-control" name="description" required="" rows="8" cols="12">{{ $UserEvents->description }}</textarea>

                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-3 ">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">Event Video Link</label>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-9 col-sm-9 ">
                      <div class="form-group">
                        <input type="url" id="event_end_time" name="eventvideo" class="form-control" placeholder="https://" value="{{ $UserEvents->event_video }}">
                      </div>
                    </div>
                  </div>
                </div>
                {{-- profile --}}
             
                <div class="pl-lg-4 profile" style="display: none">
                  <h6 class="heading-small text-muted mb-4">Organizor Details</h6>
                 
                    {{-- @foreach ( $UserProfiles as $UserProfile)
                       --}}
                  
                  
                  <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-3 ">
                      <div class="form-group">
                        <label class="form-control-label">Name</label>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-9 col-sm-9 ">
                      <div class="form-group">
                        <input type="text" id="name" name="name" class="form-control" placeholder="Name" value="{{ $UserProfile->first_name }}" >
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-3 ">
                      <div class="form-group">
                        <label class="form-control-label">Phone</label>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-9 col-sm-9 ">
                      <div class="form-group">
                        <input type="text" id="mobilenumber" name="mobilenumber" class="form-control" placeholder="Mobile Number" value="{{ $UserProfile->mobile }}">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-3 ">
                      <div class="form-group">
                        <label class="form-control-label">Email</label>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-9 col-sm-9 ">
                      <div class="form-group">
                        <input type="email" id="email" name="email" class="form-control" placeholder="Email " value="{{ $UserProfile->email }}">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-3 ">
                      <div class="form-group">
                        <label class="form-control-label">Job</label>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-9 col-sm-9 ">
                      <div class="form-group">
                        <input type="text" id="job" name="jobuser" class="form-control" placeholder="Job Name" value="{{ $UserProfile->job }}">
                      </div>
                    </div>
                  </div>

                </div>
                {{-- social --}}
                <div class="pl-lg-4 social" style="display: none">
                  <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-3 ">
                      <div class="form-group">
                        <label class="form-control-label">Facebook</label>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-9 col-sm-9 ">
                      <div class="form-group">
                        <input type="url" id="event_end_time" name="fbid" class="form-control" placeholder="https://" value="{{ $UserProfile->facebookid }}">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-3 ">
                      <div class="form-group">
                        <label class="form-control-label">Twitter</label>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-9 col-sm-9 ">
                      <div class="form-group">
                        <input type="url" id="event_end_time" name="twit" class="form-control" placeholder="https://" value="{{ $UserProfile->twitterid }}">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-3 ">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">Linked In</label>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-9 col-sm-9 ">
                      <div class="form-group">
                        <input type="url" id="event_end_time" name="linkedin" class="form-control" placeholder="https://" value="{{ $UserProfile->linkedinid}}">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-3 ">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">Youtube</label>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-9 col-sm-9 ">
                      <div class="form-group">
                        <input type="url" id="event_end_time" name="youtube" class="form-control" placeholder="https://" value="{{ $UserProfile->youtubeid }}">
                      </div>
                    </div>
                  </div>
             
                </div>
                {{-- @endforeach --}}
                <button class="btn btn-save" type="submit">Update</button>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
@endsection
@section('script')
<script src="//cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.6/jquery.tagsinput.min.js"></script>

  <script src="{{ asset('eventadmin/summernote.bundle.js') }}"></script>
  <script src="{{ asset('eventadmin/summernote.js') }}"></script>
  <script src="{{ asset('eventadmin/jquery.validate.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAL6Dg0qk25EiU3vstUKfnwNOEhE-G3vAM&libraries=places&callback=initAutocomplete" async defer></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $('.event-form-option li a').click(function(){
        $('.event-form-option li a').removeClass('active');
        var getClass = $(this).attr('data-res');
        $(this).addClass('active');
        $('.event-content-wrapper .' + getClass).siblings('div').css('display','none');
        if(getClass == 'basic'){
          $('.event-content-wrapper .basic').css('display','block');
        }else if(getClass == 'address'){
          $('.event-content-wrapper .address').css('display','block');
        }else if(getClass == 'dt'){
          $('.event-content-wrapper .dt').css('display','block');
        }else if(getClass == 'about'){
          $('.event-content-wrapper .about').css('display','block');
        }else if(getClass == "profile"){
          $('.event-content-wrapper .profile').css('display','block');
        }else if(getClass == "social"){
          $('.event-content-wrapper .social').css('display','block');
        }
      })
    })
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
    <script type="text/javascript">
      CKEDITOR.replace( 'content_editor' );
      CKEDITOR.replace( 'econtent_editor' );
  </script>
@endsection
