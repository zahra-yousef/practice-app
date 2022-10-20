@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class = "row justify-content-center">
        <div class = "col-md-6 mt-4">
            <div class="card">
                <div class="card-header">
                    <h4>Edit User Data
                        <a href="{{ route('users.index') }}" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form id="editUserForm" action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="">First Name</label>
                            <input 
                                type="text" 
                                name="name" 
                                value="{{ $user->name }}"
                                class="form-control is-valid @error('name') is-invalid @enderror"
                            >
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Last Name</label>
                            <input 
                                type="text" 
                                name="last_name" 
                                value="{{ $user->last_name }}"
                                class="form-control is-valid @error('last_name') is-invalid @enderror"
                            >
                            @error('last_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Phone</label>
                            <input 
                                type="number" 
                                name="phone" 
                                value="{{ $user->phone }}" 
                                class="form-control is-valid @error('phone') is-invalid @enderror"
                            >
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Email</label>
                            <input 
                                type="text" 
                                name="email" 
                                value="{{ $user->email }}" 
                                class="form-control is-valid @error('email') is-invalid @enderror"
                            >
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="role_as">User Role</label>
                            <select 
                                id="role_as" 
                                name="role_as"   
                                class="form-control is-valid @error('role_as') is-invalid @enderror"
                            >
                                <option value="">Select a Role</option>
                                <option value="1" {{ ($user->role_as == '1') ? 'selected' : '' }}>Admin</option>
                                <option value="0" {{ ($user->role_as == '0') ? 'selected' : '' }}>Normal user</option>
                            </select>
                            @error('role_as')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Password</label>
                            <input 
                                type="password" 
                                name="password" 
                                class="form-control is-valid @error('password') is-invalid @enderror"
                            >
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <button 
                                id="updateUser" 
                                type="submit" 
                                class="btn btn-primary">Upadate</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('frontend/js/edit_user_validation.js') }}"></script>
@endsection
