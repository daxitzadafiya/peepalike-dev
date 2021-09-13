@extends('eventusers.layout.app')
@section('style')
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
                  <h3 class="mb-0">Edit Benner </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form action="{{ url('/eventuser/updateBenner') }}" method="post" enctype="multipart/form-data">
               {{ csrf_field() }}
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Benner</label>
                        <input type="file" id="banner_image" name="banner_image" class="form-control" placeholder="Benner" required="">
                        <input type="hidden" id="id" name="id" value="{{ $EventBenner->id }}" >
                        <input type="hidden" id="event_id" name="event_id" value="{{ $EventBenner->event_id }}" >
                      </div>
                    </div>
                    <div class="col-lg-4">
                      @if($EventBenner->img_type == '1')
                        <video width="220" height="200" controls>
                          <source src="@if($EventBenner->banner_image != '') {{ url('/').'/images/'.$EventBenner->banner_image }} @else {{ 'http://placehold.it/200x200' }}  @endif" type="video/mp4">
                          Your browser does not support the video tag.
                        </video>
                      @else
                        <img src="@if($EventBenner->banner_image != '') {{ url('/').'/images/'.$EventBenner->banner_image }} @else {{ 'http://placehold.it/200x200' }}  @endif " alt="profile pic" style="width: 100px; height: 100px;">
                      @endif
                    </div>
                  </div>


                <button class="btn btn-primary" type="submit">Save</button>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
@endsection
@section('script')

  <script src="{{ asset('eventadmin/jquery.validate.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>

  <script type="text/javascript">
   $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


  </script>
@endsection
