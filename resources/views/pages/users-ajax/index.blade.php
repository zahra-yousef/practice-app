@extends('layouts.frontend')
@section('content')
    <!-- Add User Modal -->
    <div class="modal fade" id="AddUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Studnet</h5>
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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary add_user">Save</button>
            </div>
        </div>
        </div>
    </div>
    <!-- End of Add User Modal -->

    <div class="container">
        <div class = "row">
            <div class = "col-md-12 mt-4 text-center">
                <div id="success_message" class="alert alert-success"></div>
                <div class="card">
                    <div class="card-header">
                        <h4>Users Data
                            <a href="#"  data-bs-toggle="modal" data-bs-target="#AddUserModal" class="btn btn-primary float-end">Add User</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div>
                            <form action="#" method="GET">
                                <div class="input-group mb-3">
                                    <input type="search " name="user_search" id="search" class="form-control" placeholder="Enter user first name, last name or email">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary search_user" type="submit">Search</button>
                                        <a href="{{ url('/ajax-users') }}" class="btn btn-warning text-white">Refresh</a>
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
                    $('.search_user').text('Search');
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
                    }
                    else{
                        $('#add_errList').html("");
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
            $(this).text('Searching..');
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
                                <td><button type="button" value="' + user.id + '" class="btn btn-primary editbtn btn-sm">Edit</button></td>\
                                <td><button type="button" value="' + user.id + '" class="btn btn-danger deletebtn btn-sm">Delete</button></td>\
                            \</tr>');
                        });
                    }
                    $('.search_user').text('Search');
                }
            });            
        });

        //#4. Delete the user
        $(document).on('click', '.delete_user',function (e) {
            e.preventDefault();
            var user_id = $(this).val();
            $(this).text('Deleting..');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "DELETE",
                url: "/ajax-delete-user/" + user_id,
                data: "data",
                dataType: "dataType",
                success: function (response) {
                    console.log(response.message);
                    $('#success_message').text(response.message);
                    $('#success_message').show();
                    $('.delete_user').text('Delete');
                    fetchUserData();
                }
            });
        });
        
        //#5. Update the user -edit_user

        //#6. Close the modal
    });
</script>
@endsection
                                        