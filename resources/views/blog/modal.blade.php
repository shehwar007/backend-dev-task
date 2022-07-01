<div class="modal fade" id="exampleModalS" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">Add Blog</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('blog.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                    @csrf
             
                    <div class="form-group">
                        @error('name')<span class='text-danger'>*{{ "Required" }}</span> @enderror

                        <label for="recipient-name" class="control-label">Title:</label>
                        <input type="text" class="form-control" name="title" id="title" required>
                    </div>
                    <div class="form-group">


                        <label for="recipient-name" class="control-label">Content:</label>
                        <textarea class="form-control" name="content" rows="4" placeholder="Blog Content..."></textarea>
                      
                    </div>
                  



                    <div class="form-group">
                        @error('status')<span class='text-danger'>*{{ "Required" }}</span> @enderror
                        <label for="message-text" class="control-label">Status:</label>
                        <select class="form-control custom-select" name="status" id="status_id" required>
                            <option>Active</option>
                            <option>InActive</option>
                        </select>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn waves-effect waves-light btn-outline-warning" data-dismiss="modal">Close</button>
                <button type="sumbit" class="btn waves-effect waves-light btn-outline-success">Insert</button>
            </div>
            </form>
        </div>
    </div>
</div>