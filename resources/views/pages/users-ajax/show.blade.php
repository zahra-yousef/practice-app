@extends('layouts.frontend')
@section('content')
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
                        <form action="#" method="GET" id="searchform" name="searchform">
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
                    {{-- <table class="table">
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
                    </table> --}}
                    <div id="pagination_data">
                        @include("pages.users-ajax.pagination",["users"=>$users])
                    </div>
                    
                </div>
            </div>
        </div>
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
                        console.log(response.users);
                        $('tbody').html("");
                        if (response.status == 404) {
                            $('tbody').append('<tr>\
                                <td colspan="8">' + 'User data not found' + '</td>\
                            \</tr>');
                        } else {
                            $.each(response.users, function (key, user) {
                                $('tbody').append('<tr>\
                                    <td>' + user.id + '1' + '</td>\
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

            //Pagination
            $(document).on("click", "#pagination a,#search_btn", function() {
                //get url and make final url for ajax 
                var url = $(this).attr("href");
                var append = url.indexOf("?") == -1 ? "?" : "&";
                var finalURL = url + append + $("#searchform").serialize();
                //set to current url
                window.history.pushState({}, null, finalURL);
                $.get(finalURL, function(data) {
                    $("#pagination_data").html(data);
                });
                return false;
            });
        });
    </script>
@endsection