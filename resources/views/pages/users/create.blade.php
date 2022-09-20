@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class = "row justify-content-center">
        <div class = "col-md-7 mt-4">
            <div class="card">
                <div class="card-header">
                    <h4>Add User
                        <a href="{{ url('users') }}" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('store-user') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="">Name</label>
                            <input 
                                type="text" 
                                name="name" 
                                value="{{Request::old('name')}}"  
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
                                value="{{Request::old('last_name')}}"  
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
                                value="{{Request::old('phone')}}"  
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
                                value="{{Request::old('email')}}"  
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
                                value="{{Request::old('password')}}"  
                                class="form-control is-valid @error('password') is-invalid @enderror"
                            >
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection