@extends('user.layout.app')
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
@endsection
@section('content')
    <!-- Header -->
    {{-- <div class="header pb-6 d-flex align-items-center" style="min-height: 50px; margin-bottom: 10px;">

    </div> --}}
    <!-- Page content -->
    <div class="header mt--6 event-content event-listing-wrapper">
        <!-- Table -->
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <h3 class="mb-0" style="width: 80%; float: left;">My Listing/Events</h3>
                        {{-- <a href="{{ route('user.addEvent') }}" class="btn btn-info pull-right" style="color: white;"><span class="fa fa-plus"></span>&nbsp; Add Event</a> --}}
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-basic">
                            <thead class="thead-light">
                                <tr>
                                    <th>Action</th>
                                    <th>Status</th>
                                    <th>Event Name</th>
                                    <th>Vanue Name</th>
                                    <th>Start Date Time</th>
                                    <th>End Date Time</th>
                                    <th>Address</th>
                                    
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Action</th>
                                    <th>Status</th>
                                    <th>Event Name</th>
                                    <th>Vanue Name</th>
                                    <th>Start Date Time</th>
                                    <th>End Date Time</th>
                                    <th>Address</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @if (!empty($eventList))
                                    @foreach ($eventList as $key => $value)

                                        <tr>
                                         
                                            <td style="width: 125px;">
                                                {{-- <a href="{{ url( '/eventuser/eventTicket/'.$value->id )}}" class="btn btn-xs btn-primary" data-tid="{{ $value->id }}" title="Ticket"><i class="fas fa-ticket-alt"></i></a> --}}
                                                <a href="{{ url('/user/eventBenner/' . $value->id) }}"
                                                    class="btn btn-xs btn-info-color" data-tid="{{ $value->id }}"
                                                    title="Benner Upload"><i class="fas fa-photo-video"></i></a>
                                                <a href="{{ url('/user/editEvent/' . $value->id) }}"
                                                    class="btn btn-xs btn-edit" data-id="{{ $value->id }}"
                                                    title="Edit"><span class="fa fa-edit"></span></a>
                                                <button type="button" class="btn btn-xs btn-delete delete_geofance"
                                                    data-did="{{ $value->id }}" title="Delete"><span
                                                        class="fa fa-trash"></span></button>
                                            </td>
                                            <td>
                                                <label class="switch">
                                                    <input class="switch-input eisactive" type="checkbox"
                                                        id="event_status_{{ $value->id }}" name="event_status"
                                                        data-id="{{ $value->id }}" @if ($value->status == '0') {{ 'checked' }} @endif>
                                                    <span class="switch-label" data-on="Active" data-off="Inactive"></span>
                                                    <span class="switch-handle"></span>
                                                </label>
                                            </td>
                                            <td>{{ $value->event_name }}</td>
                                            <td>{{ $value->venue_name }}</td>
                                            <td>{{ $value->event_start_date . ' ' . $value->event_start_time }}</td>
                                            <td>{{ $value->event_end_date . ' ' . $value->event_end_time }}</td>
                                            <td>{{ $value->address }}</td>
                                           
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">No data found</td>
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
@section('script')
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
        integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"
        integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous">
    </script>

    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable-basic').DataTable();
        });
        $('.delete_geofance').click(function() {
            var id = $(this).data('did');
            //$('#did').val(id);
            //$('#dbasic').modal('show');
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this event!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then(function(isConfirm) {
                if (isConfirm) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url: '/user/deleteEvent/',
                        data: {
                            'did': id
                        },
                        success: function(res) {
                            swal("Deleted!", "Your event has been deleted.", "success");
                        }
                    })
                } else {
                    swal("Cancelled", "Your event is safe :)", "error");
                }
            });
        });
        $('.eisactive').change(function() {
            var id = $(this).data('id');
            if ($('#event_status_' + id + '').is(":checked")) {
                swal({
                    title: "Are you sure?",
                    icon: "info",
                    buttons: true,
                    dangerMode: true,
                }).then(function(isConfirm) {
                    if (isConfirm) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: 'POST',
                            url: '/user/activeEvent/',
                            data: {
                                'active': id
                            },
                            success: function(res) {
                                swal("info!", "Your event status has been updated.", "success");
                            }
                        })
                    } else {
                        swal("Cancelled", "Your event is safe :)", "error");
                    }
                });
            } else {
                swal({
                    title: "Are you sure?",
                    icon: "info",
                    buttons: true,
                    dangerMode: true,
                }).then(function(isConfirm) {
                    if (isConfirm) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: 'POST',
                            url: '/user/inactiveEvent/',
                            data: {
                                'deactive': id
                            },
                            success: function(res) {
                                swal("info!", "Your event status has been updated.", "success");
                            }
                        })
                    } else {
                        swal("Cancelled", "Your event is safe :)", "error");
                    }
                });
                //   $('#deactiveModal').modal('show');
                //   $('#deactive').val($(this).data('id'));
            }
        });

    </script>
@endsection
