@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class = "row justify-content-center">
        <div class = "col-md-7 mt-4">
            <div class="card">
                <div class="card-header">
                    <h4>Add Employee
                        <a href="{{ route('employees.index') }}" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form id="addEmpForm" action="{{ route('employees.store') }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="Name">Name:</label>
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
                            <label for="Email">Email:</label>
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
                            <label for="Phone">Phone Number:</label>
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
                            <label for="Designation">Designation</label>
                            <input 
                                type="text" 
                                name="designation"
                                value="{{Request::old('designation')}}"   
                                class="form-control is-valid @error('designation') is-invalid @enderror"
                            >
                            @error('designation') 
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="Status">Status</label>
                            <input 
                                type="checkbox" 
                                name="status"
                                value="1"   
                                {{ old('status') ? 'checked' : '' }}
                            > Unactive-0 / Active-1
                        </div>

                        <div class="form-group mb-3">
                            <button 
                                id="saveEmployee" 
                                type="submit" 
                                class="btn btn-primary"
                            >Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('frontend/js/employee_validation.js') }}"></script>
@endsection