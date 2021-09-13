@extends('user.layout.app')
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
                  <h3 class="mb-0">Add Ticket </h3>
                </div>
               
              </div>
            </div>
            <div class="card-body">
              <form action="{{ url('/eventuser/insertTicket') }}" method="post">
                <h6 class="heading-small text-muted mb-4">Ticket Information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Ticket Name</label>
                        <input type="text" id="ticket_name" name="ticket_name" class="form-control" placeholder="Ticket Name" required="">
                        <input type="hidden" id="event_id" name="event_id" class="form-control" placeholder="Ticket Name" value="{{ $id }}" required="">
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Available quantity</label>
                        <input type="number" id="available_quantity" name="available_quantity" class="form-control" placeholder="Available quantity" min="1" max="500" required="">
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Ticket Price</label>
                        <input type="number" id="ticket_price" name="ticket_price" class="form-control" placeholder="Ticket Price" min="1" max="1000" required="">
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Visibility</label>
                        <select class="form-control" name="visibility" id="visibility" required>
                            <option value="visible">Visible</option>
                            <option value="hidden">Hidden</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Minimum quantity</label>
                        <input type="number" id="minimum_quantity" name="minimum_quantity" class="form-control" placeholder="Minimum quantity" min="1" max="1000" required="">
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Maximum quantity</label>
                        <input type="number" id="maximum_quantity" name="maximum_quantity" class="form-control" placeholder="Maximum quantity" min="1" max="1000" required="">
                      </div>
                    </div>
                </div>
                <hr class="my-4" />
                <!-- Description -->
                <h6 class="heading-small text-muted mb-4">About Ticket</h6>
                <div class="pl-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Description</label>
                    <textarea rows="4" class="form-control summernote" placeholder="A few words about you ..." id="description" name="description" required=""></textarea>
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
  
  <script type="text/javascript">
   $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


  </script>
@endsection