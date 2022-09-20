@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class = "row justify-content-center">
        <div class = "col-md-6 mt-4">
            <div class="card">
                <div class="card-header">
                    <h4>Edit User Data
                        <a href="{{ url('users') }}" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('update-user/'.$user->id) }}" method="POST">
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
                                type="text" 
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
                            <button type="submit" class="btn btn-primary">Upadate</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection