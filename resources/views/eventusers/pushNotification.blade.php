@extends('eventusers.layout.app')
@section('style')

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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">

@endsection
@section('content')
    <!-- Header -->
    <div class="header pb-6 d-flex align-items-center" style="min-height: 50px; margin-bottom: 10px;">
     
    </div>
<!-- Page content -->
   <div class="container-fluid mt--6">
      <!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
              <h3 class="mb-0" style="width: 80%; float: left;">Push Notifications List</h3>
              <button type="button" class="btn btn-xs btn-info" data-toggle="modal" data-target="#add_status">&nbsp; Add Notifications</button>
            </div>
            <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light">
                 <tr>
                    <th>User Name</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>User Name</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
                  @if(!empty($PushNotificationsList))
                      @foreach($PushNotificationsList as $key => $value)
                          <tr>
                            <td>{{ $value->first_name.' '.$value->last_name }}</td>
                            <td>{{ $value->message }}</td>
                            <td>{{ $value->notificationStatus }}</td>
                            <td style="width: 125px;">
                              <button class="btn btn-xs btn-primary edit_user_status" data-id="{{ $value->id }}" title="Edit"><span class="fa fa-edit"></span></button>
                              <button type="button" class="btn btn-xs btn-danger delete_ticket" data-did="{{ $value->id }}" title="Delete"><span class="fa fa-trash"></span></button>
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

<div class="modal fade" id="add_status" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Send Notifications</h4>
            </div>
            <div class="modal-body">
              <form action="{{ url('/eventuser/sendPushNotifications') }}" method="post" id="add_status_form">
                  {{ csrf_field() }}
                  <div class="row">
                      <div class="col-md-12">
                          <fieldset>
                              <div class="form-group">
                                  <label class="col-md-9 control-label">Type: </label>
                                  <div class="col-md-12">
                                     <select class="custom-select col-12 text-capitalize" id="notification_type" name="notification_type">
                                        <option value="notification">Notifications</option>
                                        <option value="sms">SMS</option>
                                        <option value="email">Email</option>
                                      </select>
                                  </div>
                              </div>
                          </fieldset>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-12">
                          <fieldset>
                              <div class="form-group">
                                  <label class="col-md-6 control-label">message: </label>
                                  <div class="col-md-12">
                                     <textarea class="form-control" id="message" name="message" placeholder="Please enter message"></textarea>
                                  </div>
                              </div>
                          </fieldset>
                      </div>
                  </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-default btn-outline" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="edit_status" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Status</h4>
            </div>
            <div class="modal-body">
              <form action="{{ url('/eventuser/updateUserStatus') }}" method="post" id="edit_status_form">
                  {{ csrf_field() }}
                  <div class="row">
                      <div class="col-md-12">
                          <fieldset>
                              <div class="form-group">
                                  <label class="col-md-9 control-label">Status: </label>
                                  <div class="col-md-12">
                                     <input type="text" name="euser_status" id="euser_status" class="form-control" placeholder="Status Name" required="">
                                     <input type="hidden" name="eid" id="eid" required="">
                                  </div>
                              </div>
                          </fieldset>
                      </div>
                  </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-default btn-outline" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="dbasic" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirmation</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want remove this status ?</p>
                <form action="{{ url('/eventuser/deleteUserStatus') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="did" id="did">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Yes</button>
                <button type="button" class="btn btn-default btn-outline" data-dismiss="modal">No</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div id="deactiveModal" class="modal fade" tabindex="0" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-md">
            <div class="modal-header">
                <h4 class="modal-title">Confirmation</h4>
            </div>
            <div class="modal-body card-box">
                <p>Are you sure you want to this ticket use inactive?</p>
                <form action="{{ url('/eventuser/inactiveTicket') }}" method="post">
                    {{ csrf_field() }}
                    <input id="deactive" type="hidden" name="deactive">
                    <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">No</a>
                        <button type="submit" class="btn btn-danger">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="activeModal" class="modal fade" tabindex="0" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-md">
            <div class="modal-header">
                <h4 class="modal-title">Confirmation</h4>
            </div>
            <div class="modal-body card-box">
                <p>Are you sure you want to this ticket use active?</p>
                <form action="{{ url('/eventuser/activeTicket') }}" method="post">
                    {{ csrf_field() }}
                    <input id="active" type="hidden" name="active">
                    <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">No</a>
                        <button type="submit" class="btn btn-danger">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
  <script type="text/javascript">
   $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {
        $('#datatable-basic').DataTable();
    } );

    $('.delete_ticket').click(function(){
        var id=$(this).data('did');
        $('#did').val(id);
        $('#dbasic').modal('show');
    });
    $('.eisactive').change(function () {
          var id = $(this).data('id');
          
          if ($('#event_status_' + id + '').is(":checked")) {

              $('#activeModal').modal('show');
              $('#active').val($(this).data('id'));

          } else {

              $('#deactiveModal').modal('show');
              $('#deactive').val($(this).data('id'));

          }
      });
      $('.edit_user_status').click(function(){

        var id=$(this).data('id');
        $.ajax({
            type: 'POST',
            url : "{{ url('/eventuser/editUserStatus') }}",
            data:{id:id},
            dataType:'JSON',
            success : function (data) {

                $('#eid').val(data.id);
                $('#euser_status').val(data.status_name);
                
                $('#edit_status').modal('show');
            },error: function(xhr, ajaxOptions, thrownError){
                alert("Internal server error, Please try after some time.");
            },
        });

    });
  </script>
@endsection
