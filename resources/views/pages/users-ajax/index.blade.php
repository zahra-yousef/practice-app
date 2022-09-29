@extends('layouts.frontend')
@section('content')
    {{-- Add User Modal  --}}
    <div class="modal fade" id="AddUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="add_errList" class="alert alert-danger"></div>
                    <div class="form-group mb-3">
                        <label for="">Name</label>
                        <input 
                            type="text" 
                            name="name" 
                            class="name form-control"
                        >
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Last Name</label>
                        <input 
                            type="text" 
                            name="last_name" 
                            class="last_name form-control"
                        >
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Phone</label>
                        <input 
                            type="text" 
                            name="phone" 
                            class="phone form-control"
                        >
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Email</label>
                        <input 
                            type="text" 
                            name="email" 
                            class="email form-control"
                        >
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Password</label>
                        <input 
                            type="password" 
                            name="password" 
                            class="password form-control"
                        >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close_add_btn" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary add_user">Save</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End of Add User Modal  --}}

    {{-- Update User Modal  --}}
    <div class="modal fade" id="EditUserModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Edit User Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="update_errList" class="alert alert-danger"></div>
                    <input type="hidden" id="edit_user_id">
                    <div class="form-group mb-3">
                        <label for="">Name</label>
                        <input 
                            type="text"
                            id="edit_name" 
                            name="name" 
                            class="name form-control"
                        >
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Last Name</label>
                        <input 
                            type="text" 
                            id="edit_last_name" 
                            name="last_name" 
                            class="last_name form-control"
                        >
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Phone</label>
                        <input 
                            type="text" 
                            id="edit_phone" 
                            name="phone" 
                            class="phone form-control"
                        >
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Email</label>
                        <input 
                            type="text"
                            id="edit_email"  
                            name="email" 
                            class="email form-control"
                        >
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Password</label>
                        <input 
                            type="password" 
                            id="edit_password" 
                            name="password" 
                            class="password form-control"
                        >
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary close_update_btn" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary update_user_btn">Update</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End of Update User Modal  --}}

    {{-- Delete User Modal --}}
    <div class="modal fade" id="DeleteUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete User Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4>Confirm to Delete Data ?</h4>
                    <input type="hidden" id="deleteing_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary delete_user_btn">Yes Delete</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End of Delete User Modal --}}

    <div class="container">
        <div class = "row">
            <div class = "col-md-12 mt-4 text-center">
                <div id="success_message" class="alert alert-success"></div>
                <div class="card">
                    <div class="card-header">
                        <h4>Users Data using Ajax
                            <a href="#"  data-bs-toggle="modal" data-bs-target="#AddUserModal" class="btn btn-primary float-end">Add User</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div>
                            <form action="#" method="GET">
                                <div class="input-group mb-3">
                                    <input type="search " name="user_search" id="search" class="form-control" placeholder="Enter user first name, last name or email">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary search_user" type="submit">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </button>
                                        <a href="{{ url('/ajax-users') }}" class="btn btn-warning text-white">
                                            <i class="fa fa-refresh" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <table class="table">
                            <thead>
                              <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Edit</th>
                                <th>Delete</th>
                              </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4 float-end">
            {{-- {{ pagination }} --}}
        </div>
    </div>
@endsection
@section('scripts')
<script>
    $(document).ready(function () {
        fetchUserData();
        $('#success_message').hide();
        $('#add_errList').hide();
        $('#update_errList').hide();

        //#1. Show Users
        function fetchUserData(){
            $.ajax({
                type: "GET",
                url: "/ajax-show-users",
                dataType: "json",
                success: function (response) {
                   // console.log(response.users);
                   $('tbody').html("");
                    if (response.status == 404) {
                        $('tbody').append('<tr>\
                            <td colspan="8">' + 'User data not found' + '</td>\
                        \</tr>');
                    } else {
                        $.each(response.users, function (key, user) {
                            $('tbody').append('<tr>\
                                <td>' + user.id + '</td>\
                                <td>' + user.name + '</td>\
                                <td>' + user.last_name + '</td>\
                                <td>' + user.email + '</td>\
                                <td>' + user.phone + '</td>\
                                <td><button type="button" value="' + user.id + '" class="btn btn-primary edit_user btn-sm">Edit</button></td>\
                                <td><button type="button" value="' + user.id + '" class="btn btn-danger delete_user btn-sm">Delete</button></td>\
                            \</tr>');
                        });
                    }

                }
            });
        }

        //#2. Insert User
        $(document).on('click', '.add_user',function (e) {
            e.preventDefault(); //Prevent page from loading

            $(this).text('Sending..');

            //Create user object from inerted data 
            var user = {
                'name': $('.name').val(),
                'last_name': $('.last_name').val(),
                'phone': $('.phone').val(),
                'email': $('.email').val(),
                'password': $('.password').val(),
            }

        //    console.log(user);
 
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "/ajax-add-user",
                data: user,
                dataType: "json",
                success: function (response) {
                    if (response.status == 400) {
                        // console.log(response);
                        $('#add_errList').html("");
                        $('#add_errList').show();
                        $.each(response.errors, function (key, err_value) {
                            $('#add_errList').append('<p>' + err_value + '</p>');
                        });
                        $('.add_user').text('Save');
                        $('.btn-close').find('input').val('');
                    }
                    else{
                        $('#add_errList').html("");
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#success_message').show();
                        $('#AddUserModal').find('input').val('');
                        $('.add_user').text('Save');
                        $('#AddUserModal').modal('hide');
                        fetchUserData();
                    }
                }
            });            
        });

        //#3. Search User
        $(document).on('click', '.search_user',function (e) {
            e.preventDefault(); //Prevent page from loading
          
            var query= $('#search').val();
            $.ajax({
                type: "GET",
                url: "/ajax-search-user",
                data: {'search':query},
                dataType: "json",
                success: function (response) {
                    // console.log(response.users);
                    $('tbody').html("");
                    if (response.status == 404) {
                        $('tbody').append('<tr>\
                            <td colspan="8">' + 'User data not found' + '</td>\
                        \</tr>');
                    } else {
                        $.each(response.users, function (key, user) {
                            $('tbody').append('<tr>\
                                <td>' + user.id + '</td>\
                                <td>' + user.name + '</td>\
                                <td>' + user.last_name + '</td>\
                                <td>' + user.email + '</td>\
                                <td>' + user.phone + '</td>\
                                <td><button type="button" value="' + user.id + '" class="btn btn-primary edit_user btn-sm">Edit</button></td>\
                                <td><button type="button" value="' + user.id + '" class="btn btn-danger delete_user btn-sm">Delete</button></td>\
                            \</tr>');
                        });
                    }
                }
            });            
        });

        //#4. Delete the user
        $(document).on('click', '.delete_user', function () {
            var user_id = $(this).val();
            $('#deleteing_id').val(user_id);
            // console.log('first: ' + user_id);
            $('#DeleteUserModal').modal('show');
        });

        $(document).on('click', '.delete_user_btn',function (e) {
            e.preventDefault();
            var user_id = $('#deleteing_id').val();
            $(this).text('Deleting..');
            // console.log('second: ' + user_id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "DELETE",
                url: "/ajax-delete-user/" + user_id,
                dataType: "json",
                success: function (response) {
                    // console.log(response.message);
                    $('#success_message').addClass('alert alert-success');
                    $('#success_message').text(response.message);
                    $('#success_message').show();
                    $('.delete_user_btn').text('Delete');
                    $('#DeleteUserModal').modal('hide');
                    fetchUserData();
                }
            });
        });
        
        //#5. Update the user
        $(document).on('click', '.edit_user',function (e) {
            e.preventDefault();
            var user_id = $(this).val();
            // console.log(user_id);
            $('#EditUserModal').modal('show');
            $.ajax({
                type: "GET",
                url: "/ajax-show-user/" + user_id,
                success: function (response) {
                    // console.log(response.status);
                    if(response.status == 404){
                        $('#success_message').html("");
                        $('#success_message').addClass('alert alert-danger');
                        $('#success_message').text(response.message);
                        $('#success_message').show();
                        $('#EditUserModal').modal('hide'); 
                    } else {
                        // console.log(response.user);
                        $('#edit_name').val(response.user.name);
                        $('#edit_last_name').val(response.user.last_name);
                        $('#edit_email').val(response.user.email);
                        $('#edit_phone').val(response.user.phone);
                        $('#edit_user_id').val(user_id);
                    }
                }
            });
            $('.btn-close').find('input').val('');
        });

        $(document).on('click', '.update_user_btn',function (e) {
            e.preventDefault();
            $(this).text('Updating..');
            var user_id = $('#edit_user_id').val();
            var user = {
                'name' : $('#edit_name').val(),
                'last_name' : $('#edit_last_name').val(),
                'email' : $('#edit_email').val(),
                'phone' : $('#edit_phone').val(),
                'password' : $('#edit_password').val(),
            }
            // To support put method
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "PUT",
                url: "/ajax-update-user/" + user_id,
                data: user,
                dataType: "json",
                success: function (response) {
                    // console.log(response);
                    if(response.status == 400){
                        $('#update_errList').html("");
                        $('#update_errList').show();
                        $.each(response.errors, function (key, err_value) {
                            $('#update_errList').append('<p>' + err_value + '</p>'); 
                        });
                        $('.update_user_btn').text('Update');
                    }else{
                        // console.log(response.message);
                        $('#update_errList').html("");
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#success_message').show();
                        $('#update_errList').hide();
                        $('#EditUserModal').find('input').val('');
                        $('.update_user_btn').text('Update');
                        $('#EditUserModal').modal('hide');
                        fetchUserData();
                    }
                }
            });
        });

        //#6. Close the modal
        function closeAddModal(){
            $('#success_message').hide();
            $('#add_errList').html("");
            $('#add_errList').hide();
            $('#AddUserModal').find('input').val('');
            $('.add_user').text('Save');
            $('#AddUserModal').modal('hide');
            fetchUserData();
        }

        function closeUpdateModal(){
            $('#success_message').hide();
            $('#update_errList').html("");
            $('#update_errList').hide();
            $('#EditUserModal').find('input').val('');
            $('.update_user_btn').text('Update');
            $('#EditUserModal').modal('hide');
            fetchUserData();
        }

        $(document).on('click', '.btn-close', function () {
            closeAddModal();
            closeUpdateModal();
        });

        $(document).on('click', '.close_add_btn', function () {
            closeAddModal();
        });

        $(document).on('click', '.close_update_btn', function () {
            closeUpdateModal();
        });
    });
</script>
@endsection
                                        