@extends('layouts.frontend')
@section('content')
{{-- Add User Modal  --}}
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="POST" id="add_user_form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4 bg-light">
                    <div class="row">
                      <div class="col-sm">
                        <label for="name">First Name</label>
                        <input 
                            type="text" 
                            name="name" 
                            class="form-control" 
                            placeholder="First Name" 
                            required
                        >
                      </div>
                      <div class="col-sm">
                        <label for="last_name">Last Name</label>
                        <input 
                            type="text" 
                            name="last_name" 
                            class="form-control" 
                            placeholder="Last Name" 
                            required
                        >
                      </div>
                    </div>
                    <div class="my-2">
                        <label for="phone">Phone</label>
                        <input 
                            type="tel" 
                            name="phone" 
                            class="form-control" 
                            placeholder="Phone" 
                            required
                        >
                    </div>
                    <div class="my-2">
                        <label for="email">E-mail</label>
                        <input 
                            type="email" 
                            name="email" 
                            class="form-control" 
                            placeholder="E-mail" 
                            required
                        >
                    </div>
                    <div class="my-2">
                        <label for="role_as">User Role</label>
                        <select 
                            name="role_as"   
                            class="form-control"
                            required
                        >
                            <option value="">Select a Role</option>
                            <option value="1">Admin</option>
                            <option value="0">Normal user</option>
                        </select>
                    </div>
                    <div class="my-2">
                        <label for="">Password</label>
                        <input 
                            type="password" 
                            name="password" 
                            class="form-control"
                            placeholder="Password" 
                            required
                        >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="add_user_btn" class="btn btn-primary">Add User</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- add new user modal end --}}

{{-- edit User modal start --}}
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="edit_user_form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="user_id" id="user_id">
        <div class="modal-body p-4 bg-light">
          <div class="row">
            <div class="col-sm">
              <label for="name">First Name</label>
              <input 
                  type="text" 
                  id="name"
                  name="name" 
                  class="form-control" 
                  placeholder="First Name" 
                  required
              >
            </div>
            <div class="col-sm">
              <label for="last_name">Last Name</label>
              <input 
                  type="text" 
                  id="last_name"
                  name="last_name" 
                  class="form-control" 
                  placeholder="Last Name" 
                  required
              >
            </div>
          </div>
          <div class="my-2">
            <label for="email">E-mail</label>
            <input 
              type="email" 
              name="email" 
              id="email" 
              class="form-control" 
              placeholder="E-mail" 
              required
            >
          </div>
          <div class="my-2">
            <label for="phone">Phone</label>
            <input 
              type="tel" 
              name="phone" 
              id="phone" 
              class="form-control" 
              placeholder="Phone" 
              required
            >
          </div>
          <div class="my-2">
            <label for="role_as">User Role</label>
            <select 
              id="role_as" 
              name="role_as"   
              class="form-control"
              required
            >
              <option value="">Select a Role</option>
              <option value="1">Admin</option>
              <option value="0">Normal user</option>
            </select>
        </div>
        <div class="my-2">
          <label for="">Password</label>
          <input 
            type="password" 
            id="password"
            name="password" 
            class="form-control"
            placeholder="Password" 
            required
          >
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="edit_user_btn" class="btn btn-success">Update User</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- edit User modal end --}}

<div class="container">
    <div class="row my-5">
        <div class="col-lg-12">
            <div class="card shadow">
              <div class="card-header bg-danger d-flex justify-content-between align-items-center">
                  <h3 class="text-light">Users Data using Ajax</h3>
                  <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addUserModal"><i
                    class="bi-plus-circle me-2"></i>Add New User</button>
              </div>
              <div class="card-body" id="show_all_users">
                <h1 class="text-center text-secondary my-5">Loading...</h1>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
  @include('pages.users-ajax.validation_js')
  @include('pages.users-ajax.users_js2')
@endsection