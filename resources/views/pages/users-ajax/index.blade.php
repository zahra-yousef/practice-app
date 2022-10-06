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
                        <label for="role_as">User Role</label>
                        <select 
                            id="role_as" 
                            name="role_as"   
                            class="role_as form-control"
                        >
                            <option value="">Select a Role</option>
                            <option value="1">Admin</option>
                            <option value="0">Normal user</option>
                        </select>
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
                        <label for="role_as">User Role</label>
                        <select 
                            id="edit_role_as" 
                            name="role_as"   
                            class="role_as form-control"
                        >
                            <option value="">Select a Role</option>
                            <option value="1">Admin</option>
                            <option value="0">Normal user</option>
                        </select>
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
                                        <a href="{{ route('ajax-users.index') }}" class="btn btn-warning text-white">
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
                        {{-- <div id="pagination_data">
                            @include("pages.users-ajax.pagination",["users"=>$users])
                        </div> --}}
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
    @include('pages.users-ajax.users_js')
@endsection
                                        