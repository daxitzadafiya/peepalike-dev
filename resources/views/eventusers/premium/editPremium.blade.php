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
                  <h3 class="mb-0">Edit Premium </h3>
                </div>
               
              </div>
            </div>
            <div class="card-body">
              <form action="{{ url('/eventuser/updatePremium') }}" method="post" >
                <h6 class="heading-small text-muted mb-4">Premium Information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Premium Name</label>
                        <input type="text" id="plan_name" name="plan_name" class="form-control" placeholder="Premium Name" value="{{ $EventPremium->plan_name }}" required="">
                        <input type="hidden" id="plan_id" name="plan_id" class="form-control" value="{{ $EventPremium->id }}" required="">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Premium Price ($)</label>
                        <input type="text" id="price" name="price" class="form-control" placeholder="Price" min="0" max="500" value="{{ $EventPremium->price }}" required="">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Premium Duration</label>
                        <select class="form-control" name="duration" id="duration" required>
                          <option value="">Select Duration</option>
                            <option value="day" @if($EventPremium->duration == 'day') {{ 'selected' }} @endif >Day</option>
                            <option value="month" @if($EventPremium->duration == 'month') {{ 'selected' }} @endif >Monthly</option>
                            <option value="quarter" @if($EventPremium->duration == 'quarter') {{ 'selected' }} @endif >Quarterly</option>
                            <option value="year" @if($EventPremium->duration == 'year') {{ 'selected' }} @endif >Yearly</option>
                        </select>
                      </div>
                      
                    </div>
                  </div>
                  
                </div>
                
                <hr class="my-4" />
                <!-- Description -->
                <h6 class="heading-small text-muted mb-4">About Premium</h6>
                <div class="pl-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Description</label>
                    <textarea rows="4" class="form-control summernote" placeholder="A few words about you ..." id="description" name="description" required="">{{ $EventPremium->description }}</textarea>
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

  </script>
@endsection