@extends('eventusers.layout.app')
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
              <h3 class="mb-0" style="width: 80%; float: left;">Event List</h3>
              <a href="{{ route('admin.addEvent') }}" class="btn btn-info pull-right" style="color: white;"><span class="fa fa-plus"></span>&nbsp; Add Event</a>
            </div>
            <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light">
                  <tr>
                    <th>Action</th>
                    <th>Event Name</th>
                    <th>Vanue Name</th>
                    <th>Start Date Time</th>
                    <th>End Date Time</th>
                    <th>Address</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Action</th>
                    <th>Event Name</th>
                    <th>Vanue Name</th>
                    <th>Start Date Time</th>
                    <th>End Date Time</th>
                    <th>Address</th>
                    <th>Status</th>
                  </tr>
                </tfoot>
                <tbody>
                  @if(!empty($eventList))
                      @foreach($eventList as $key => $value)
                          <tr>
                            <td style="width: 125px;">
                              <a href="{{ url( '/eventuser/eventTicket/'.$value->id )}}" class="btn btn-xs btn-primary" data-tid="{{ $value->id }}" title="Ticket"><i class="fas fa-ticket-alt"></i></a>
                              <a href="{{ url( '/eventuser/eventBenner/'.$value->id )}}" class="btn btn-xs btn-primary" data-tid="{{ $value->id }}" title="Benner Upload"><i class="fas fa-photo-video"></i></a>
                              <a href="{{ url( '/eventuser/editEvent/'.$value->id )}}" class="btn btn-xs btn-primary" data-id="{{ $value->id }}" title="Edit"><span class="fa fa-edit"></span></a>
                              <button type="button" class="btn btn-xs btn-danger delete_geofance" data-did="{{ $value->id }}" title="Delete"><span class="fa fa-trash"></span></button>
                            </td>
                            <td>{{ $value->event_name }}</td>
                            <td>{{ $value->venue_name }}</td>
                            <td>{{ $value->event_start_date.' '.$value->event_start_time }}</td>
                            <td>{{ $value->event_end_date.' '.$value->event_end_time }}</td>
                            <td>{{ $value->address }}</td>
                            <td>
                              <label class="switch">
                                  <input class="switch-input eisactive" type="checkbox" id="event_status_{{ $value->id }}" name="event_status" data-id="{{ $value->id }}" @if($value->status == '0') {{ 'checked' }} @endif>
                                  <span class="switch-label" data-on="Active" data-off="Inactive"></span>
                                  <span class="switch-handle"></span>
                              </label>
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
<div class="modal fade" id="dbasic" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirmation</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want remove this Event ?</p>
                <form action="{{ url('/eventuser/deleteEvent') }}" method="post">
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
                <p>Are you sure you want to this event use inactive?</p>
                <form action="{{ url('/eventuser/inactiveEvent') }}" method="post">
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
                <p>Are you sure you want to this event use active?</p>
                <form action="{{ url('/eventuser/activeEvent') }}" method="post">
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
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
        $('#datatable-basic').DataTable();
    } );

    $('.delete_geofance').click(function(){
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
  </script>
@endsection
