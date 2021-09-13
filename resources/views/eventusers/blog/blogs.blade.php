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
        width: 100%;
        text-align: center;
        font-size: 13px;
        padding: 8px 12px;
        margin: 0;
        color: #fff;
      }

      .inactive-status{
        background: #dc3545;
        border-radius: 5px;
        width: 100%;
        text-align: center;
        font-size: 13px;
        padding: 8px 12px;
        margin: 0;
        color: #fff;
      }
      .tokenizationSelect2{
        width: 300px;
      }
      .select2-selection--multiple{
        padding: 0 !important;
        border: 1px solid #ced4db !important;
        box-shadow: unset !important;
      }
      .select2-selection__choice{
        background: #e4e4e47a !important;
        color: #616e7b !important;
      }
      #etags_tagsinput, #emeta_tag_tagsinput,#tag_tagsinput,#meta_tag_tagsinput{
        width: 100% !important;
        min-height: 100px !important;
        height: calc(1.5em + 0.75rem + 2px) !important;
      }
      .tag{
        background: #f1f1f1 !important;
        color: #000 !important;
        border: 1px solid #e0dfdf !important;
      }
      .tag a{
          color: #615c5e !important;
      }
      .response-message-wrapper{
        width: 100%;
        margin: 10px 30px 0;
      }
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.6/jquery.tagsinput.min.css" rel="stylesheet">
@endsection
@section('content')
    <!-- Header -->
    <div class="header pb-6 d-flex align-items-center" style="min-height: 50px; margin-bottom: 10px;">
        @if(session()->has('error'))
            <div class="alert alert-danger response-message-wrapper">
                {{ session()->get('error') }}
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success response-message-wrapper">
                {!! session('success') !!}
            </div>
        @endif
    </div>
<!-- Page content -->
   <div class="container-fluid mt--6">
      <!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
              <h3 class="mb-0" style="width: 80%; float: left;">Blog List</h3>
              <button type="button" class="btn btn-xs btn-info" data-toggle="modal" data-target="#add_blog">&nbsp; Add New Blog</button>
            </div>
            <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light">
                 <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
                  @if(!empty($BlogList))
                      @foreach($BlogList as $key => $value)
                          <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->blog_title }}</td>
                            <td><img src="@if($value->blog_image != '') {{ $value->blog_image }} @else {{ 'http://placehold.it/200x200' }}  @endif " alt="profile pic" style="width: 100px; height: 100px;"> </td>
                            <td>{{ $value->blog_author }}</td>
                            <td>{{ $value->category_type }}</td>
                            @if($value->status == 'active')
                            <td><p class="active-status">{{ 'Active' }}</p></td>
                            @else
                            <td><p class="inactive-status">{{ 'Inactive' }}</p></td>
                            @endif
                            <td>{{ date('d M Y',strtotime($value->created_at)) }}</td>
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
<div class="modal fade" id="add_blog" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Blog</h4>
            </div>
            <div class="modal-body">
              <form action="{{ url('/eventuser/insertBlog') }}" method="post" id="add_blog_form" enctype="multipart/form-data">
                  {{ csrf_field() }}
                   <div class="row">
                      <div class="col-md-7">
                          <fieldset>
                              <div class="form-group">
                                  <label class="col-md-9 control-label">Title: </label>
                                  <div class="col-md-12">
                                     <input type="text" name="title" id="title" class="form-control" placeholder="Title" required="">
                                  </div>
                              </div>
                          </fieldset>
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-md-9 control-label">Content: </label>
                                    <div class="col-md-12">
                                    <textarea type="text" id="content_editor" class="form-control" name="content" required="" rows="4">
                                    </textarea>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-5">
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-md-9 control-label">Category: </label>
                                    <div class="col-md-12">
                                        <select name="category" id="category" class="form-control">
                                            <option value="">Select Category</option>
                                            @foreach ($Category as $value)    
                                                <option value="{{$value['category_name']}}">{{$value['category_name']}}</option>
                                            @endforeach
                                        </select>                                        
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-md-9 control-label">Tags: </label>
                                    <div class="col-md-12">
                                        <input name="tag" id="tag" class="form-control" />
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-md-9 control-label">Author: </label>
                                    <div class="col-md-12">
                                    <input type="text" name="author" id="author" class="form-control" placeholder="Author">
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-md-9 control-label">Meta Tags: </label>
                                    <div class="col-md-12">
                                        <input name="meta_tag" id="meta_tag" class="form-control" />
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-md-9 control-label">Meta Description: </label>
                                    <div class="col-md-12">
                                    <textarea rows="4" name="meta_des" id="meta_des" class="form-control" placeholder="Meta Description"></textarea>
                                    </div>
                                </div>
                            </fieldset>
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
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-md-9 control-label">Image: </label>
                                    <div class="col-md-12">
                                       <input type="file" name="image" id="image" class="form-control" placeholder="Image" required="" onchange="loadImgFile(event)">
                                       <img src="#" id="AddImg" style="width: 100px; height: 100px;display:none;padding: 10px 0;">
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                   </div>
                   <div class="modal-footer">
                       <button type="submit" class="btn btn-success">Save</button>
                       <button type="button" class="btn btn-default btn-outline" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="edit_blog" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Blog</h4>
            </div>
            <div class="modal-body">
              <form action="{{ url('/eventuser/updateBlog') }}" method="post" id="edit_blog_form" enctype="multipart/form-data">
                  {!! csrf_field() !!}
                  <div class="row">
                    <div class="col-md-7">
                        <fieldset>
                            <div class="form-group">
                                <label class="col-md-9 control-label">Title: </label>
                                <div class="col-md-12">
                                   <input type="text" name="etitle" id="etitle" class="form-control" placeholder="Title" required="">
                                   <input type="hidden" name="eid" id="eid" required="">
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="form-group">
                                <label class="col-md-9 control-label">Content: </label>
                                <div class="col-md-12">
                                    <textarea type="text" id="econtent_editor" class="form-control econtent" name="econtent" required="" rows="4"></textarea>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-md-5">
                        <fieldset>
                            <div class="form-group">
                                <label class="col-md-9 control-label">Category: </label>
                                <div class="col-md-12">
                                <select name="ecategory" id="ecategory" class="form-control">
                                    <option value="">Select Category</option>
                                    @foreach ($Category as $value)    
                                        <option value="{{$value['category_name']}}">{{$value['category_name']}}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="form-group">
                                <label class="col-md-9 control-label">Tags: </label>
                                <div class="col-md-12">
                                    <input  name="etags" id="etags" class="form-control"/>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="form-group">
                                <label class="col-md-9 control-label">Author: </label>
                                <div class="col-md-12">
                                <input type="text" name="eauthor" id="eauthor" class="form-control" placeholder="Author" >
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="form-group">
                                <label class="col-md-9 control-label">Meta Tags: </label>
                                <div class="col-md-12">
                                    <input name="emeta_tag" id="emeta_tag" class="form-control" />
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="form-group">
                                <label class="col-md-9 control-label">Meta Description: </label>
                                <div class="col-md-12">
                                    <textarea rows="4" name="emeta_des" id="emeta_des" class="form-control" placeholder="Meta Description"></textarea>
                                </div>
                            </div>
                        </fieldset>
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
                        <fieldset>
                            <div class="form-group">
                                <label class="col-md-9 control-label">Image: </label>
                                <div class="col-md-12">
                                    <input type="file" name="eimage" id="eimage" class="form-control" placeholder="Image" onchange="loadUpdateFile(event)">
                                    <img src="#" id="UpdateImg" style="width: 100px; height: 100px;padding: 10px 0;">
                                </div>
                            </div>
                        </fieldset>
                    </div>
                 </div>
                 <div class="modal-footer">
                     <button type="submit" class="btn btn-success">Save</button>
                     <button type="button" class="btn btn-default btn-outline" data-dismiss="modal">Close</button>
                    </div>
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
                <p>Are you sure you want remove this blog ?</p>
                <form action="{{ url('/eventuser/deleteBlog') }}" method="post">
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

@endsection
@section('script')
    <script src="{{ asset('eventadmin/summernote.bundle.js') }}"></script>
    <script src="{{ asset('eventadmin/summernote.js') }}"></script>
    <script src="{{ asset('eventadmin/jquery.validate.min.js') }}"></script>
    <!-- <script src="https://cdn.ckeditor.com/ckeditor5/28.0.0/classic/ckeditor.js"></script> -->
    <script src="//cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.6/jquery.tagsinput.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">   
        $(document).ready(function() {
            $('#tag').tagsInput();
            $('#etags').tagsInput();
            $('#meta_tag').tagsInput();
            $('#emeta_tag').tagsInput();
            $('#datatable-basic').DataTable();
            $('.tagsinput').addClass('form-control');
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')    
            }
        });

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
                url : "/eventuser/editBlog/" + id,
                data :{},
                dataType:'JSON',
                success : function (res) {
                    $('#eid').val(id);
                    $('#etitle').val(res.blog_title);
                    $('#ecategory').val(res.category_type);
                    if (res.blog_tags != null) {
                        $('#etags').importTags(res.blog_tags);
                    }
                    $('#eauthor').val(res.blog_author);
                    if(res.meta_tag != null){
                        $('#emeta_tag').importTags(res.meta_tag);
                    }
                    $('#emeta_des').val(res.meta_description);
                    $('#estatus').val(res.status);
                    $('#UpdateImg').attr('src',res.blog_image);
                    CKEDITOR.instances['econtent_editor'].setData(res.blog_content)
                    $('#edit_blog').modal('show');
                }
            });

        });
        
        var loadImgFile = function(event) {
            $('#AddImg').css('display','block');
            var reader = new FileReader();
            reader.onload = function(){
            var output = document.getElementById('AddImg');
            output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        };

        var loadUpdateFile = function(event) {
            var reader = new FileReader();
            reader.onload = function(){
            var output = document.getElementById('UpdateImg');
            output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        };
    </script>
    <script type="text/javascript">
        CKEDITOR.replace( 'content_editor' );
        CKEDITOR.replace( 'econtent_editor' );
    </script>
@endsection
