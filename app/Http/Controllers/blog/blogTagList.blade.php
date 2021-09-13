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

      .active-status {
        background: #2cd48c;
        border-radius: 5px;
        width: 14%;
        text-align: center;
        font-size: 13px;
        padding: 8px 12px;
        margin: 0;
        color: #fff;
      }

      .inactive-status{
        background: #dc3545;
        border-radius: 5px;
        width: 14%;
        text-align: center;
        font-size: 13px;
        padding: 8px 12px;
        margin: 0;
        color: #fff;
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
              <h3 class="mb-0" style="width: 80%; float: left;">Blog Tag List</h3>
              <button type="button" class="btn btn-xs btn-info" data-toggle="modal" data-target="#add_tag">&nbsp; Add New Tag</button>
            </div>
            <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light">
                 <tr>
                    <th>Tag Name</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Tag Name</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
                  @if(!empty($BlogTagsList))
                      @foreach($BlogTagsList as $key => $value)
                          <tr>
                            <td>{{ $value->tag_name }}</td>
                            @if($value->status == 'active')
                            <td><p class="active-status">{{ 'Active' }}</p></td>
                            @else
                            <td><p class="inactive-status">{{ 'Inactive' }}</p></td>
                            @endif
                            <td style="width: 125px;">
                              <button class="btn btn-xs btn-primary edit_category" data-id="{{ $value->id }}" title="Edit"><span class="fa fa-edit"></span></button>
                              <button type="button" class="btn btn-xs btn-danger delete_category" data-did="{{ $value->id }}" title="Delete"><span class="fa fa-trash"></span></button>
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

<div class="modal fade" id="add_tag" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Tag</h4>
            </div>
            <div class="modal-body">
              <form action="{{ url('/eventuser/blog/insertTag') }}" method="post" id="add_tag_form" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="row">
                      <div class="col-md-12">
                          <fieldset>
                              <div class="form-group">
                                  <label class="col-md-9 control-label">Tag Name: </label>
                                  <div class="col-md-12">
                                     <input type="text" name="tag_name" id="tag_name" class="form-control" placeholder="Tag Name" required="">
                                  </div>
                              </div>
                          </fieldset>
                      </div>
                      <div class="col-md-12">
                        <fieldset>
                            <div class="form-group">
                                <label class="col-md-9 control-label">Status: </label>
                                <div class="col-md-12">
                                    <select name="status" id="status" class="form-control">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
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

<div class="modal fade" id="edit_tag" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Tag</h4>
            </div>
            <div class="modal-body">
              <form action="{{ url('/eventuser/blog/updateTag') }}" method="post" id="edit_tag_form" enctype="multipart/form-data">
                  {!! csrf_field() !!}
                  <div class="row">
                      <div class="col-md-12">
                          <fieldset>
                              <div class="form-group">
                                  <label class="col-md-9 control-label">Tag Name: </label>
                                  <div class="col-md-12">
                                     <input type="text" name="etag_name" id="etag_name" class="form-control" placeholder="Tag Name" required="">
                                     <input type="hidden" name="eid" id="eid" required="">
                                  </div>
                              </div>
                          </fieldset>
                      </div>
                      <div class="col-md-12">
                          <fieldset>
                              <div class="form-group">
                                  <label class="col-md-9 control-label">Status: </label>
                                  <div class="col-md-12">
                                    <select name="estatus" id="estatus" class="form-control">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
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
                <p>Are you sure you want remove this tag ?</p>
                <form action="{{ url('/eventuser/blog/deleteTag') }}" method="post">
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

    $('.delete_category').click(function(){
        var id=$(this).data('did');
        $('#did').val(id);
        $('#dbasic').modal('show');
    });
    
    $('.edit_category').click(function(){
        var id = $(this).data('id');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'GET',
            url : "/eventuser/blog/editTag/" + id,
            data :{},
            dataType:'JSON',
            success : function (res) {
                console.log(res);
                $('#eid').val(res.id);
                $('#etag_name').val(res.tag_name);
                $('#estatus').val(res.status);
                
                $('#edit_tag').modal('show');
            }
        });

    });
  </script>
@endsection
