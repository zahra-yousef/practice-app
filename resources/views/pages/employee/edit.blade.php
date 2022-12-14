@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class = "row justify-content-center">
        <div class = "col-md-6 mt-4">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Employee Data
                        <a href="{{ route('employees.index') }}" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form id="editEmpForm" action="{{ route('employees.update', $employee->id) }}" method="POST">
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
                                value="{{ '0'.$employee->phone }}" 
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
                            <input 
                                type="checkbox" 
                                name="status" 
                                value="1"
                                {{ $employee->status == 1 ? 'checked' : ''}}
                            > Unactive-0 / Active-1
                        </div>
                        <div class="form-group mb-3">
                            <button 
                                id="upadteEmployee" 
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
    <script type="text/javascript" src="{{ asset('frontend/js/edit_employee_validation.js') }}"></script>
@endsection
