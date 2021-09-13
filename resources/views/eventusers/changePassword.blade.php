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
                  <h3 class="mb-0">Change Password </h3>
                </div>
               
              </div>
            </div>
            <div class="card-body">
               <div class="col-md-12 col-sm-12 col-xs-12" id="editinfo" style="display: none;">
                    <div class="alert alert-success" role="alert"></div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12" id="editdanger" style="display: none;">
                    <div class="alert alert-danger" role="alert"></div>
                </div>
              <form action="" method="post" id="cform">
                {{ csrf_field() }}
                  <div class="row clearfix">
                      <div class="col-lg-12 col-md-12">
                          <div class="form-group">
                              <input type="password" class="form-control" placeholder="New Password"  id="npassword" name="npassword" required>
                          </div>
                          <div class="form-group">
                              <input type="password" class="form-control" placeholder="Confirm New Password" id="ncpassword" name="ncpassword" required>
                          </div>
                      </div>
                  </div>
                  <button type="submit" class="btn btn-round btn-primary">Submit</button> &nbsp;&nbsp;
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

   $(function(){
        $("#cform").validate({
            rules: {
                npassword: {
                    required: true,
                    minlength: 7
                },
                ncpassword: {
                    required: true,
                    equalTo:npassword,
                    minlength: 7
                }

            },
            submitHandler: function(form) {
                var npassword=$('#npassword').val();
                var ncpassword=$('#ncpassword').val();
                
                $.ajax({
                    type:'POST',
                    data:{npassword:npassword,ncpassword:ncpassword},
                    dataType:'JSON',
                    url : "{{ url('/eventuser/postChangePassword') }}",
                    async: false,
                    success:function(data) {
                        if(data.error == true){
                            $('#editdanger').show().children('div').html(data.message).show().fadeOut(10000);
                            return;
                        }else{
                            $('#editinfo').show().children('div').html(data.message).show().fadeOut(10000);
                            setTimeout(function(){
                                location.reload();
                            }, 1000);
                        }

                    },error: function(xhr, ajaxOptions, thrownError){
                        $('#adddanger').show().children('div').html('Internal server error, Please try after some time.').show().fadeOut(10000);
                    }
                });

            }
        });
    });

  </script>
@endsection