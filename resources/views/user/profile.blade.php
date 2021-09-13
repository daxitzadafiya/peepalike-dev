@extends('user.layout.app')
@section('style')
    <link rel="stylesheet" href="{{ asset('eventadmin/summernote/dist/summernote.css') }}">
    <style>
        .image-preview {
            width: 100px;
            border-radius: 15%;
            height: auto;
            margin-left: 187px;
            margin-bottom: 11px;
            margin-top: -11px;
        }
        .error {
            color: red
        }

    </style>
@endsection
@section('content')
    {{-- <!-- Header -->
    <div class="header pb-6 d-flex align-items-center" style="min-height: 50px; margin-bottom: 10px;">

    </div> --}}
    <!-- Page content -->
    <div class="header pb-6 mt--6 event-content">
        @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <ul class="p-0 m-0" style="list-style: none;">
            <li>{{ session()->get('error') }}</li>
            </ul>
        </div>
    @endif
    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <ul class="p-0 m-0" style="list-style: none;">
            <li>{{ session()->get('success') }}</li>
            </ul>
        </div>
    @endif
        <div class="row">
            <div class="col-xl-12 order-xl-1 event-heading">
                <h3 class="">Profile</h3>
        </div>
        <div class=" col-xl-12 order-xl-1 event-form-wrapper">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="event-form-option">
                                    <ul>
                                        <li><a class="btn profile active" data-res="profile">Profile</a></li>
                                        <li><a class="btn change_password" data-res="change_password">Change Password</a></li>
                                        {{-- <li><a class="btn dt" data-res="dt">Date & Time</a></li>
                                        <li><a class="btn about" data-res="about">About</a></li> --}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body event-content-wrapper">
                            <div class="pl-lg-4 profile">
                                <h6 class="heading-small text-muted mb-4">User Profile</h6>
                                <form action="{{ route('store.profile') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id"
                                        value="{{ Auth::user()->id != null ? Auth::user()->id : '' }}">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 ">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-first-name">First Name</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-9 col-sm-9 ">
                                            <div class="form-group">
                                                <input type="text" id="user_first_name" name="first_name"
                                                    class="form-control" placeholder="Enter First Name"
                                                    value="{{ Auth::user()->first_name ? Auth::user()->first_name : '' }}"
                                                    required>
                                                    @if($errors->has('first_name'))
                                                        <div class="error">{{ $errors->first('first_name') }}</div>
                                                    @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 ">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-last-name">Last Name</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-9 col-sm-9 ">
                                            <div class="form-group">
                                                <input type="text" id="user_last_name" name="last_name"
                                                    class="form-control" placeholder="Enter Last Name"
                                                    value="{{ Auth::user()->last_name != null ? Auth::user()->last_name : '' }}"
                                                    required>
                                                @if($errors->has('last_name'))
                                                    <div class="error">{{ $errors->first('last_name') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 ">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-email">Email</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-9 col-sm-9 ">
                                            <div class="form-group">
                                                <input type="text" id="user_email" name="email" class="form-control"
                                                    placeholder="Enter Email"
                                                    value="{{ Auth::user()->email != null ? Auth::user()->email : '' }}"
                                                    required>
                                                    @if($errors->has('email'))
                                                            <div class="error">{{ $errors->first('email') }}</div>
                                                    @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 ">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-mobile">Contact No</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-9 col-sm-9 ">
                                            <div class="form-group">
                                                <input type="text" id="user_mobile" name="mobile" class="form-control"
                                                    placeholder="Enter Contact No"
                                                    value="{{ Auth::user()->mobile != null ? Auth::user()->mobile : '' }}">
                                                @if($errors->has('mobile'))
                                                    <div class="error">{{ $errors->first('mobile') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 ">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-address">Address</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-9 col-sm-9 ">
                                            <div class="form-group">
                                                <input type="text" id="user_address" name="address" class="form-control"
                                                    placeholder="Enter Address"
                                                    value="{{ Auth::user()->address != null ? Auth::user()->address : '' }}">
                                                @if($errors->has('address'))
                                                    <div class="error">{{ $errors->first('address') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @if (Auth::user()->image != null)
                                        <div class="row">
                                            <div class="col-md-4">
                                                @if (Auth::user()->is_avatar == 1)
                                                    <img class="image-preview"
                                                        src="{{ Auth::user()->image != null ? Auth::user()->image : '' }}"
                                                        alt="">
                                                @else
                                                    <img class="image-preview"
                                                        src="{{ Auth::user()->image != null ? url('/images/user_profile') . '/' . Auth::user()->image : url('/eventadmin/img/theme/team-4.jpg') }}">
                                                @endif
                                            </div>
                                            <div class="col-md-3">
                                                <a href="{{ route('user.remove_profile_image', ['id' => Auth::id()]) }}"
                                                    class="btn btn-danger btn-sm">Remove</a>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 ">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-image">Image</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-9 col-sm-9 ">
                                            <div class="form-group">
                                                <input type="file" id="user_image" name="image" class="form-control">
                                                @if($errors->has('image'))
                                                    <div class="error">{{ $errors->first('image') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-save" type="submit">Save Profile</button>
                                </form>
                            </div>
                            <!-- Address -->
                            <div class="pl-lg-4 change_password" style="display: none">
                                <form action="{{ route('user.update_password',['id' => Auth::id()]) }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 ">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-old-password">Old Password</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-9 col-sm-9 ">
                                            <div class="form-group">
                                                <input id="user_old_password" name="old_password" class="form-control"
                                                    placeholder="Enter old password" type="password">
                                                @if($errors->has('old_password'))
                                                    <div class="error">{{ $errors->first('old_password') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 ">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-new-password">New Password</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-9 col-sm-9 ">
                                            <div class="form-group">
                                                <input id="user_new_password" name="new_password" class="form-control"
                                                    placeholder="Enter new password" type="password">
                                                @if($errors->has('new_password'))
                                                    <div class="error">{{ $errors->first('new_password') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 ">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-confirm-password">Confirm Password</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-9 col-sm-9 ">
                                            <div class="form-group">
                                                <input id="user_password_confirmation" name="password_confirmation" class="form-control"
                                                    placeholder="Enter confirm password" type="password">
                                                @if($errors->has('password_confirmation'))
                                                    <div class="error">{{ $errors->first('password_confirmation') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-save" type="submit">Update Password</button>
                                </form>
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
                                            <input type="date" id="event_start_date" name="event_start_date"
                                                class="form-control" placeholder="Start Date" required="">
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
                                            <input type="time" id="event_start_time" name="event_start_time"
                                                class="form-control" placeholder="Start Time" required="">
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
                                            <input type="date" id="event_end_date" name="event_end_date"
                                                class="form-control" placeholder="End Date" required="">
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
                                            <input type="time" id="event_end_time" name="event_end_time"
                                                class="form-control" placeholder="End Time" required="">
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
                                    <div class="col-lg-5 col-md-9 col-sm-9 ">
                                        <div class="form-group">
                                            <textarea rows="4" class="form-control "
                                                placeholder="A few words about you ..." id="description" name="description"
                                                required=""></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAL6Dg0qk25EiU3vstUKfnwNOEhE-G3vAM&libraries=places&callback=initAutocomplete"
        async defer></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.event-form-option li a').click(function() {
                $('.event-form-option li a').removeClass('active');
                var getClass = $(this).attr('data-res');
                $(this).addClass('active');
                $('.event-content-wrapper .' + getClass).siblings('div').css('display', 'none');
                if (getClass == 'profile') {
                    $('.event-content-wrapper .profile').css('display', 'block');
                } else if (getClass == 'change_password') {
                    $('.event-content-wrapper .change_password').css('display', 'block');
                } else if (getClass == 'dt') {
                    $('.event-content-wrapper .dt').css('display', 'block');
                } else if (getClass == 'about') {
                    $('.event-content-wrapper .about').css('display', 'block');
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
                if (addressType === 'country') {
                    $('#country').val(place.address_components[i].long_name);
                    $('#country').click();
                } else if (addressType === 'administrative_area_level_1') {
                    $('#state').val(place.address_components[i].long_name);

                } else if (addressType === 'locality' || addressType == 'administrative_area_level_2') {
                    $('#city').val(place.address_components[i].long_name);
                } else if (addressType === 'postal_code') {
                    $('#postal_code').val(place.address_components[i].long_name);

                } else {}
            }
        }
        $('#event_location').click(function() {
            var event_location = $('#event_location').val();
            if (event_location == 'online') {
                $('.showaddress').hide();
            } else {
                $('.showaddress').show();
            }
        });
    </script>
@endsection
