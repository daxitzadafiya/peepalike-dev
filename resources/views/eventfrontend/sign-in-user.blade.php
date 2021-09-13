@section('modal')
<div class="modal fade" id="signIn" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Blog</h4>
            </div>
            <div class="modal-body">
              <form action="" method="post" id="add_blog_form" enctype="multipart/form-data">
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
@endsection