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
                  <h3 class="mb-0">Edit User </h3>
                </div>
               
              </div>
            </div>
            <div class="card-body">
              <form action="{{ url('/eventuser/updateUser') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <h6 class="heading-small text-muted mb-4">User Information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name" required="" value="{{ $userDetail->first_name }}">
                        <input type="hidden" id="id" name="id" value="{{ $userDetail->id }}" >
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last name" required="" value="{{ $userDetail->last_name }}">
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Email" required="" value="{{ $userDetail->email }}">
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Phone</label>
                        <input type="number" id="mobile" name="mobile" class="form-control" placeholder="Phone" required="" value="{{ $userDetail->mobile }}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Profile Image</label>
                        <input type="file" id="event_image" name="event_image" class="form-control" placeholder="Event Image" required="">
                      </div>
                    </div>
                    <div class="col-lg-2">
                      <div class="form-group">
                        <img src="@if($userDetail->image != '') {{ url('/').'/images/'.$userDetail->image }} @else {{ 'http://placehold.it/200x200' }}  @endif " alt="profile pic" style="width: 100px; height: 100px;"> 
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Age</label>
                        <input type="number" id="age" name="age" class="form-control" placeholder="Age" required="" value="{{ $userDetail->age }}">
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
                        <input id="address" name="address" class="form-control" placeholder="Home Address"  type="text" required="" value="{{ $userDetail->address }}">
                        <input type="hidden" id="latitude" name="latitude" value="{{ $userDetail->latitude }}" >
                        <input type="hidden" id="longitude" name="longitude" value="{{ $userDetail->longitude }}">
                      </div>
                    </div>
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
    
  </script>
@endsection