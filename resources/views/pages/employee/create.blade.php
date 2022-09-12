@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class = "row justify-content-center">
        <div class = "col-md-6 mt-4">
            <div class="card">
                <div class="card-header">
                    <h4>Add Employee
                        <a href="{{ url('employee') }}" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('store-employee') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <div>
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>

                            <div>
                                <label for="">Email</label>
                                <input type="text" name="email" class="form-control">
                            </div>
                            <div>
                                <label for="">Phone</label>
                                <input type="text" name="phone" class="form-control">
                            </div>
                            <div>
                                <label for="">Designation</label>
                                <input type="text" name="designation" class="form-control">
                            </div>
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