@extends('layouts.frontend')
@section('content')
    @include('pages.users-ajax.add-modal')
    @include('pages.users-ajax.update-modal')
    @include('pages.users-ajax.delete-modal')
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
                                </div>
                            </form>
                        </div>
                        <div class="table-data">@include('pages.users-ajax.pagination')</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @include('pages.users-ajax.validation_js')
    @include('pages.users-ajax.users_js')
@endsection
                                        