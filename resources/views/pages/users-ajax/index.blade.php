@extends('layouts.frontend')
@section('content')
    @include('pages.users-ajax.add-modal')
    @include('pages.users-ajax.update-modal')
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
                        {{-- <h1 class="text-center text-secondary my-5">Loading...</h1> --}}
                        <div class="table-responsive"> 
                            <table id="viewTable" class="table table-striped table-hover table-sm text-center align-middle">
                                <thead>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Phone</th>
                                        <th class="text-center">E-mail</th>
                                        <th class="text-center">Edit</th>
                                        <th class="text-center">Delete</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @include('pages.users-ajax.users_js') 
@endsection