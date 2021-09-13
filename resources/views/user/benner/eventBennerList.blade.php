@extends('user.layout.app')
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
 <style>
      .checkbox-inline {
          display: inline-block;
          padding-left: 20px;
          margin-bottom: 0;
          font-weight: normal;
          vertical-align: middle;
          cursor: pointer;
      }

      .switch {
          position: relative;
          display: block;
          vertical-align: top;
          width: 100px;
          height: 30px;
          padding: 3px;
          margin: 0 10px 10px 0;
          background: linear-gradient(to bottom, #FFFFFF, #FFFFFF 25px);
          background-image: -webkit-linear-gradient(top, #FFFFFF, #FFFFFF 25px);
          border-radius: 18px;
          box-shadow: inset 0 -1px #FFFFFF, inset 0 1px 1px rgba(0, 0, 0, 0.05);
          cursor: pointer;
      }
      .switch-input {
          position: absolute;
          top: 0;
          left: 0;
          opacity: 0;
      }
      .switch-label {
          position: relative;
          display: block;
          height: inherit;
          font-size: 10px;
          text-transform: uppercase;
          background: #4EA5E0;
          border-radius: inherit;
          box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.12), inset 0 0 2px rgba(0, 0, 0, 0.15);
      }
      .switch-label:before, .switch-label:after {
          position: absolute;
          top: 50%;
          margin-top: -.5em;
          line-height: 1;
          -webkit-transition: inherit;
          -moz-transition: inherit;
          -o-transition: inherit;
          transition: inherit;
      }
      .switch-label:before {
          content: attr(data-off);
          right: 11px;
          color: #ffffff;
          text-shadow: 0 1px rgba(255, 255, 255, 0.5);
      }
      .switch-label:after {
          content: attr(data-on);
          left: 11px;
          color: #FFFFFF;
          text-shadow: 0 1px rgba(0, 0, 0, 0.2);
          opacity: 0;
      }
      .switch-input:checked ~ .switch-label {
          background: #4ea5e0;
          box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.15), inset 0 0 3px rgba(0, 0, 0, 0.2);
      }
      .switch-input:checked ~ .switch-label:before {
          opacity: 0;
      }
      .switch-input:checked ~ .switch-label:after {
          opacity: 1;
      }
      .switch-handle {
          position: absolute;
          top: 4px;
          left: 4px;
          width: 28px;
          height: 28px;
          background: linear-gradient(to bottom, #FFFFFF 40%, #f0f0f0);
          background-image: -webkit-linear-gradient(top, #FFFFFF 40%, #f0f0f0);
          border-radius: 100%;
          box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.2);
      }
      .switch-handle:before {
          content: "";
          position: absolute;
          top: 50%;
          left: 50%;
          margin: -6px 0 0 -6px;
          width: 12px;
          height: 12px;
          background: linear-gradient(to bottom, #eeeeee, #FFFFFF);
          background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF);
          border-radius: 6px;
          box-shadow: inset 0 1px rgba(0, 0, 0, 0.02);
      }
      .switch-input:checked ~ .switch-handle {
          left: 74px;
          box-shadow: -1px 1px 5px rgba(0, 0, 0, 0.2);
      }

      /* Transition
      ========================== */
      .switch-label, .switch-handle {
          transition: All 0.3s ease;
          -webkit-transition: All 0.3s ease;
          -moz-transition: All 0.3s ease;
          -o-transition: All 0.3s ease;
      }
  </style>
@endsection
@section('content')
    <!-- Header -->
    {{-- <div class="header pb-6 d-flex align-items-center" style="min-height: 50px; margin-bottom: 10px;">

    </div> --}}
<!-- Page content -->
   <div class="event-content mt--6 event-banner-wrapper">
      <!-- Table -->
      <div class="row">
        <div class="col-xl-12 order-xl-1">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h4 class="mb-0">Add Benner </h4>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form action="{{ url('/user/insertBenner') }}" method="post" enctype="multipart/form-data">
                  <div class="row event-banner-info">
                    <div class="col-lg-4 col-md-6 col-sm-7">
                      <div class="form-group">
                        <input type="file" id="banner_image" name="banner_image" class="form-control" placeholder="Benner" required="">
                        <input type="hidden" id="event_id" name="event_id" class="form-control" value="{{ $id }}" required="">
                      </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-4">
                      <button class="btn btn-save form-control" type="submit">Save Benner</button>
                    </div>
                  </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-xl-12 order-xl-1">
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
              <h4 class="mb-0" style="width: 100%; float: left;">Event Benner List</h4>
            </div>
            <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light">
                  <tr>
                    <th>Benners</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                   <tr>
                    <th>Benners</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
                  @if(!empty($eventBennerList))
                      @foreach($eventBennerList as $key => $value)
                          <tr>
                            <td>
                              @if($value->img_type == '1')
                                <video width="320" height="240" controls>
                                  <source src="@if($value->banner_image != '') {{ url('/').'/images/'.$value->banner_image }} @else {{ 'http://placehold.it/200x200' }}  @endif" type="video/mp4">
                                  Your browser does not support the video tag.
                                </video>
                              @else
                                <img src="@if($value->banner_image != '') {{ url('/').'/images/'.$value->banner_image }} @else {{ 'http://placehold.it/200x200' }}  @endif " alt="profile pic" style="width: 100px; height: 100px;">
                              @endif

                            </td>

                            <td style="width: 125px;">
                              <button type="button" class="btn btn-xs btn-edit edit-banner" data-id="{{ $value->id }}" title="Edit"><span class="fa fa-edit"></span></button>
                              <button type="button" class="btn btn-xs btn-delete delete_ticket" data-did="{{ $value->id }}" title="Delete"><span class="fa fa-trash"></span></button>
                            </td>
                          </tr>
                      @endforeach
                  @else
                      <tr>
                          <td colspan="4">no data found</td>
                      </tr>
                  @endif

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
@section('modal')
<div class="modal fade event-banner-edit" id="edit-banner-modal" role="basic" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="">Edit Banner</h4>
              <button type="button" class="close sign-in-close" data-dismiss="modal" aria-label="Close">
              <i class="fa fa-times-circle" aria-hidden="true"></i>
              </button>
          </div>
          <div class="modal-body">
            <form action="{{ url('/user/updateBenner') }}" method="post" enctype="multipart/form-data">
              <div class="row edit-banner-wrapper">
                  <div class="col-12 form-group">
                    <input type="file" id="ebanner_image" name="banner_image" class="form-control" placeholder="Benner" required="">
                    <input type="hidden" id="eid" name="id" value="" >
                    <input type="hidden" id="eevent_id" name="event_id" value="" >
                  </div>
                  <div class="col-12">
                    <video width="220" height="200" controls style="display: none">
                      <source id="evideo" src="" type="video/mp4">
                      Your browser does not support the video tag.
                    </video>
                    <img id="eimg" src="" alt="profile pic" style="width: 100px; height: 100px; display:none">
                  </div>
              </div>
              <button class="btn btn-save mt-4 form-control editEvent" type="submit">Save Benner</button>
            </form>
          </div>
      </div>
      <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
@endsection
@section('script')
{{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  <script src="{{ asset('eventadmin/jquery.validate.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
        $('#datatable-basic').DataTable();
    });

    $('.delete_ticket').click(function(){
        var id=$(this).data('did');
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this banner!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then(function(isConfirm){
            if (isConfirm) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type : 'POST',
                    url  : '/user/deleteBenner/',
                    data : {'did':id},
                    success : function(res) {
                        swal("Deleted!", "Event banner has been deleted.", "success");
                        setTimeout(() => {
                          location.reload(true);
                        }, 1000);
                    }
                })
            } else {
                swal("Cancelled", "Event banner is safe :)", "error");
            }
        });
    });
    $('.edit-banner').click(function(){
      var id=$(this).data('id');
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
        type : "GET",
        url : "/user/editBenner/" + id,
        data : {},
        success : function(res){
          var get_url = window.location.href;
          var url = get_url.split('/');
          $('#eid').val(res.id);
          $('#eevent_id').val(res.event_id);
          if(res.img_type == '1'){
            $('.edit-banner-wrapper video').css('display','block');
            if(res.banner_image != ''){
              $('#evideo').attr('src','/images/' + res.banner_image);
            }else{
              $('#evideo').attr('src','http://placehold.it/200x200');
            }
          }else{
            $('.edit-banner-wrapper img').css('display','block');
            if(res.banner_image != ''){
              $('#eimg').attr('src','/images/' + res.banner_image);
            }else{
              $('#eimg').attr('src','http://placehold.it/200x200');
            }
          }
          $('#edit-banner-modal').modal('show');
        }
      });
    });
  </script>
@endsection
