@extends('layouts.app')
@section('PageTitle', 'User')
@push('mycss')
<!--here is you css-->
@endpush

<!--here is content-->
@section('page_content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row m-b-20">
                    <div class="col-lg-11">
                        <h4 class="card-title">User List</h4>

                    </div>
                    <div class="col-lg-1">
                        <button type="button" class="btn waves-effect waves-light btn-outline-success" data-toggle="modal" data-target="#exampleModalS" data-whatever="@mdo">Add User</button>

                    </div>
                </div>
                <div class="table-responsive">
                    <table id="file_export" class="table table-striped table-bordered">
                        <thead>
                            <tr>


                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>


                        </tbody>
                        <tfoot>

                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('modal')
@endsection
@push('myscript')
<!--here is your js-->
<!-- <script>
    $('#file_export').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
    $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-cyan text-white mr-1');
</script> -->
<script>
    //=============================================//
    //    File export                              //
    //=============================================//
    $(function() {
        $('#file_export').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('user.getdata') }}",
            dom: 'Bfrtip',
            responsive: true,
            scrollY: false,
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],

            "lengthMenu": [
                [10, 25, 50, 100, 200, -1],
                [10, 25, 50, 100, 200, "All"]
            ],
            columns: [{
                    "data": 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },

                {
                    data: 'name',
                    name: 'name'
                },



                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'role',
                    name: 'role'
                },

                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action'
                }

            ]

        });
        $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-cyan text-white mr-1');
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $("#userinsert").submit(function(e) {
        e.preventDefault();
        let name = $("#name_id").val();
        let password = $("#password_id").val();
        let email = $("#email_id").val();
        let role = $("#role_id").val();
        let status = $("#status_id").val();

        $.ajax({
            url: "{{route('user.store')}}",
            type: "POST",
            data: {
                name: name,
                password: password,
                email: email,
                role: role,
                status: status,
            },
            success: function(response) {
                console.log(response);
                if (response) {

                    $('#file_export').DataTable().ajax.reload();
                    $('#exampleModalS').modal('hide');
                    $("#userinsert")[0].reset();
                    success_msg("User Added Successfully");
                } else {
                   
                    error_msg("Some thing went wrong")


                }

            }
        });




    });

    function edit_user(id) {
        $.get('/edit_user/' + id, function(data) {
            $("#id").val(data.id);
            $("#name").val(data.name);
            $("#password").val('');
            $("#email").val(data.email);
            $("#role").val(data.role);
            $("#status").val(data.status);
            $('#exampleModalEdit').modal('toggle');
        })
    }

    $("#userupdate").submit(function(e) {
        e.preventDefault();
        let id = $("#id").val();
        let name = $("#name").val();
        let password = $("#password").val();
        let email = $("#email").val();
        let role = $("#role").val();
        let status = $("#status").val();

        $.ajax({
            url: "{{route('user.update')}}",
            type: "POST",
            data: {
                id: id,
                name: name,
                password: password,
                email: email,
                role: role,
                status: status,
            },
            success: function(response) {
                console.log(response);
                if (response) {
                    $('#exampleModalEdit').modal('hide');
                    $('#file_export').DataTable().ajax.reload();
                    $("#userupdate")[0].reset();
                    success_msg("User update Successfully");
                   
                }else{
                    error_msg("Some thing went wrong");
                }

            }
        });


    });

    function delete_user(id) {
        if (confirm("do You want to Delete this User?")) {
            $.get('/delete_user/' + id, function(data) {
                if (data) {
                    $('#file_export').DataTable().ajax.reload();
                    success_msg("User Delete Successfully");
                  

                } else {
                    error_msg("Some thing went wrong");
                   
                }


            })
        }

    }

    function success_msg(msg) {
        swal("Success!", msg, "success")
    }

    function error_msg(msg) {
        swal("Error!", msg, "error")
    }
</script>
@endpush