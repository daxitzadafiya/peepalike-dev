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
                  <h3 class="mb-0">Add Event </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form action="{{ url('/eventuser/insertEvent') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <h6 class="heading-small text-muted mb-4">Event Information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Event Name</label><span style="color: red">(*)</span>
                        <input type="text" id="event_name" name="event_name" class="form-control" placeholder="Event Name" required="">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Vanue Name</label><span style="color: red">(*)</span>
                        <input type="text" id="vanue_name" name="vanue_name" class="form-control" placeholder="Vanue name" required="">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Job</label><span style="color: red">(*)</span>
                        <select class="form-control" name="event_job" required>
                          <option value="For CEO">For CEO</option>
                          <option value="For Individual">For Individual</option>
                          <option value="For Manager">For Manager</option>
                      </select>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Event Image</label><span style="color: red">(*)</span>
                        <input type="file" id="event_image" name="event_image" class="form-control" placeholder="Event Image" required="" accept="image/*">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Event Location</label><span style="color: red">(*)</span>
                        <select class="form-control" name="event_location" id="event_location" required>
                            <option value="venue">Venue</option>
                            <option value="online">Online event</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Event Ticket</label><span style="color: red">(*)</span>
                        <select class="form-control" name="event_type" id="event_type" required>
                            <option value="get ticket">Get Ticket</option>
                            <option value="free">Free</option>
                        </select>
                      </div>
                    </div>
                      <div class="col-lg-3 ">
                        <div class="form-group">
                          <label class="form-control-label" for="input-first-name">Category</label><span style="color: red">(*)</span>
                        <select class="form-control" name="category" id="event_type" required>
                            <option value="get ticket">Select Category</option>
                            @foreach( $category as $item)
                              <option value="{{ $item->cname }}">{{ $item->cname }}</option>
                            @endforeach


                          </select>
                        </div>
                      </div>

                    <div class="col-lg-3">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Is trending event?</label><span style="color: red">(*)</span>
                        <select class="form-control" name="trending_event" id="trending_event" required>
                            <option value="no">No</option>
                            <option value="yes">Yes</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4 showaddress" />
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4 showaddress">Street Address</h6><span style="color: red">(*)</span>
                <div class="pl-lg-4 showaddress">
                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label class="form-control-label" for="input-address">Address</label><span style="color: red">(*)</span>
                        <input id="address" name="address" class="form-control" placeholder="Home Address"  type="text" required="">
                        <input type="hidden" id="latitude" name="latitude" value="">
                        <input type="hidden" id="longitude" name="longitude" value="">
                      </div>
                    </div>
                  
                 
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-address">Space</label><span style="color: red">(*)</span>
                        <select class="form-control" name="space" id="trending_event" required>
                          <option value="no">In room</option>
                          <option value="yes">Out Side</option>
                      </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                          <label class="form-control-label" for="input-city">City</label><span style="color: red">(*)</span>
                          <input id="city" name="city" class="form-control" placeholder="Home Address"  type="text" required="">
                          <!-- <select class="form-control" name="city" id="city" required>
                              <option>Select City</option>
                          </select> -->
                        </div>
                    </div>
                
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label class="form-control-label" for="input-city">State</label><span style="color: red">(*)</span>
                        <input id="state" name="state" class="form-control" placeholder="Home Address"  type="text"  required="">
                        <!-- <select class="form-control" name="state" id="state" required>
                            <option >Select State</option>
                        </select> -->
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">Country</label><span style="color: red">(*)</span>
                        <input id="country" name="country" class="form-control" placeholder="Home Address"  type="text" required="">
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
                        <label class="form-control-label" for="input-country">Postal code</label><span style="color: red">(*)</span>
                        <input type="number" id="postal_code" name="postal_code" class="form-control" placeholder="Postal code" required="">
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />

                <!-- Profile  -->
                <h6 class="heading-small text-muted mb-4">Organizor Contact Details</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-city">Name</label><span style="color: red">(*)</span>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Name" value="{{ $UserProfile->first_name }}">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        {{-- pattern="[0-9]{5}[-][0-9]{7}[-][0-9]{1}"  --}}
                        <label class="form-control-label" for="input-city">Phone</label><span style="color: red">(*)</span>
                        <input type="number" id="mobilenumber"  name="mobilenumber" class="form-control" placeholder="Mobile Number" value="{{ $UserProfile->mobile }}">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">Email</label><span style="color: red">(*)</span>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Email " value="{{ $UserProfile->email }}">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">Job</label><span style="color: red">(*)</span>
                        <input type="text" id="job" name="jobuser" class="form-control" placeholder="Job Name" required="" value="{{ $UserProfile->job }}">
                      </div>
                    </div>

                    {{-- <a href="#" ><i class="fas fa-plus-square"></i></a> --}}
 {{-- Social   Account Details --}}
                    
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">Facebook</label>
                        <input type="url" id="event_end_time"pattern="(?:(?:http|https):\/\/)?(?:www.)?facebook.com\/(?:(?:\w)*#!\/)?(?:pages\/)?(?:[?\w\-]*\/)?(?:profile.php\?id=(?=\d.*))?([\w\-]*)?" name="fbid" class="form-control" placeholder="https://" value="{{ $UserProfile->fbid }}">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">Twitter</label>
                        <input type="url" id="event_end_time" pattern="/http(?:s)?:\/\/(?:www\.)?twitter\.com\/([a-zA-Z0-9_]+)/ "name="twit" class="form-control" placeholder="https://" value="{{ $UserProfile->twitterid }}">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">Linked In</label>
                        <input type="url" id="event_end_time" name="linkedin" class="form-control" placeholder="https://" value="{{ $UserProfile->linkedinid }}">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">Youtube</label>
                        <input type="url" id="event_end_time" pattern="http(?:s?):\/\/(?:www\.)?youtu(?:be\.com\/watch\?v=|\.be\/)([\w\-\_]*)(&(amp;)?‌​[\w\?‌​=]*)?" name="youtube" class="form-control" placeholder="https://" value="{{ $UserProfile->youtubeid }}">
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
                        <input type="date" id="event_start_date" name="event_start_date" class="form-control" placeholder="Start Date" required="">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-city">Start Time</label>
                        <input type="time" id="event_start_time" name="event_start_time" class="form-control" placeholder="Start Time" required="">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">End Date</label>
                        <input type="date" id="event_end_date" name="event_end_date" class="form-control" placeholder="End Date" required="">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">End Time</label>
                        <input type="time" id="event_end_time" name="event_end_time" class="form-control" placeholder="End Time" required="">
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
                    <textarea type="text" id="content_editor" class="form-control" name="description" required="" rows="8" cols="8"></textarea>
                  </div>
                </div>
                <h6 class="heading-small text-muted mb-4">Event Video Link</h6>
                <div class="pl-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Event Video</label>
                    <input type="url" id="event_end_time" pattern="http(?:s?):\/\/(?:www\.)?youtu(?:be\.com\/watch\?v=|\.be\/)([\w\-\_]*)(&(amp;)?‌​[\w\?‌​=]*)?" name="eventvideo" class="form-control" placeholder="https://">
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
<script src="//cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.6/jquery.tagsinput.min.js"></script>

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
  <script type="text/javascript">
    CKEDITOR.replace( 'content_editor' );
    CKEDITOR.replace( 'econtent_editor' );
</script>
@endsection
