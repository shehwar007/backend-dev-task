<div class="modal fade" id="exampleModalS" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">Add User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <!-- <form action="{{ route('user.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                    @csrf -->
                    <form id="userinsert" method="POST">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <div class="form-group">
                        @error('name')<span class='text-danger'>*{{ "Required" }}</span> @enderror

                        <label for="recipient-name" class="control-label">Name:</label>
                        <input type="text" class="form-control" name="name" id="name_id" required>
                    </div>
                    <div class="form-group">


                        <label for="recipient-name" class="control-label">Email:</label>
                        <input type="text" class="form-control" name="email" id="email_id" required>
                        @error('email')<span class='text-danger'>*{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        @error('password')<span class='text-danger'>*{{ "Required" }}</span> @enderror

                        <label for="recipient-name" class="control-label">Paswword:</label>
                        <input type="password" class="form-control" name="password" id="password_id" required>
                    </div>
                    <div class="form-group">
                        @error('role')<span class='text-danger'>*{{ "Required" }}</span> @enderror
                        <label for="message-text" class="control-label">User Role:</label>
                        <select class="form-control custom-select" name="role" id="role_id"  required>
                            <option value="">----select role----</option>
                            @foreach($role_dropdown as $data)
                            <option>{{$data}}</option>
                            @endforeach
                          
                        </select>
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

<!-- Edit model-->
<div class="modal fade" id="exampleModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">Edit User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <!-- <form action="{{ route('user.update') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                    @csrf -->
                    <form id="userupdate" method="POST">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <input type="hidden" class="form-control" id="id" name="id" required>
                    <div class="form-group">
                        @error('name')<span class='text-danger'>*{{ "Required" }}</span> @enderror

                        <label for="recipient-name" class="control-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">


                        <label for="recipient-name" class="control-label">Email:</label>
                        <input type="text" class="form-control" id="email" name="email" required>
                        @error('email')<span class='text-danger'>*{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        @error('password')<span class='text-danger'>*{{ "Required" }}</span> @enderror

                        <label for="recipient-name" class="control-label">Paswword:</label></br>
                        <span class='text-danger'>leave empty if you don't want to change password</span>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="form-group">
                        @error('role')<span class='text-danger'>*{{ "Required" }}</span> @enderror
                        <label for="message-text" class="control-label">User Role:</label>
                        <select class="form-control custom-select" name="role" id="role" required>
                            <option value="">----select role----</option>
                            @foreach($role_dropdown as $data)
                            <option>{{$data}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        @error('status')<span class='text-danger'>*{{ "Required" }}</span> @enderror
                        <label for="message-text" class="control-label">Status:</label>
                        <select class="form-control custom-select" id="status" name="status" required>
                            <option>Active</option>
                            <option>InActive</option>
                        </select>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn waves-effect waves-light btn-outline-warning" data-dismiss="modal">Close</button>
                <button type="sumbit" class="btn waves-effect waves-light btn-outline-success">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>