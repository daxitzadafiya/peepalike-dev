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
                  <h3 class="mb-0">Static Pages</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form action="{{ url('/eventuser/insertEvent') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Privacy Policy Content</label>
                        <textarea type="text" id="privacy_editor" class="form-control" name="privacy_content" required="" rows="5">
                          <p><strong>Privacy Policy</strong></p>
                          <p>Appdupe built the datesauce app as an Open Source app. This SERVICE is provided by [Developer/Company name] at no cost and is intended for use as is.This page is used to inform visitors regarding [my/our] policies with the collection, use, and disclosure of Personal Information if anyone decided to use [my/our] Service.If you choose to use [my/our] Service, then you agree to the collection and use of information in relation to this policy. The Personal Information that [I/We] collect is used for providing and improving the Service. [I/We] will not use or share your information with anyone except as described in this Privacy Policy.The terms used in this Privacy Policy have the same meanings as in our Terms and Conditions, which is accessible at datesauce unless otherwise defined in this Privacy Policy.</p>
                        </textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Terms Content</label>
                        <textarea type="text" id="terms_editor" class="form-control" name="terms_content" required="" rows="5">
                          <p>212,na,szmczxzxz</p>
                        </textarea>
                      </div>
                    </div>
                  </div>
                </div>
                <button class="btn btn-primary" type="submit">Update</button>
                <button class="btn btn-danger" type="submit">Cancel</button>
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
  <!-- <script src="https://cdn.ckeditor.com/ckeditor5/28.0.0/classic/ckeditor.js"></script> -->
  <script src="//cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
  <script type="text/javascript">
    CKEDITOR.replace( 'privacy_editor' );
    CKEDITOR.replace( 'terms_editor' );
    // CKEDITOR.replace('myeditor1');
</script>
<!--   <script>
          ClassicEditor
            .create( document.querySelector( '#privacy_editor' ) )
            .then( editor => {
                    console.log( editor );
            } )
            .catch( error => {
                    console.error( error );
            } );
  </script> -->
@endsection