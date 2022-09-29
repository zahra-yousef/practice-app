@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class = "row justify-content-center">
        <div class = "col-md-6 mt-4">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $user->name }} Information
                        <a href="{{ route('users.show') }}" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="">First Name</label>
                        <input 
                            type="text" 
                            name="name" 
                            value="{{ $user->name }}"
                            disabled
                        >
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Last Name</label>
                        <input 
                            type="text" 
                            name="last_name" 
                            value="{{ $user->last_name }}"
                            disabled
                        >
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Phone</label>
                        <input 
                            type="text" 
                            name="phone" 
                            value="{{ $user->phone }}" 
                            disabled
                        >
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Email</label>
                        <input 
                            type="text" 
                            name="email" 
                            value="{{ $user->email }}" 
                            disabled
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection