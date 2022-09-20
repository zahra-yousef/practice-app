@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class = "row justify-content-center">
        <div class = "col-md-6 mt-4">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Employee Data
                        <a href="{{ url('employee') }}" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('update-employee/'.$employee->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="">Name</label>
                            <input 
                                type="text" 
                                name="name" 
                                value="{{ $employee->name }}"
                                class="form-control is-valid @error('name') is-invalid @enderror"
                            >
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Email</label>
                            <input 
                                type="text" 
                                name="email" 
                                value="{{ $employee->email }}" 
                                class="form-control is-valid @error('email') is-invalid @enderror"
                            >
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Phone</label>
                            <input 
                                type="text" 
                                name="phone" 
                                value="{{ $employee->phone }}" 
                                class="form-control is-valid @error('phone') is-invalid @enderror"
                            >
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Designation</label>
                            <input 
                                type="text" 
                                name="designation" 
                                value="{{ $employee->designation }}" 
                                class="form-control is-valid @error('designation') is-invalid @enderror"
                            >
                            @error('designation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Status</label>
                            <input type="checkbox" name="status" {{ $employee->status == 1 ? 'checked' : ''}}> Unactive-1 / Active-0
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