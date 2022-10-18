@extends('layouts.frontend')
@section('content')
    <div class="container">
        <div class = "row">
            <div class = "col-md-12 mt-4 text-center">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                @if ($errors->any())
                    <ul class="alert alert-warning">
                        @foreach ($errors->all() as $error)
                        <li> {{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4>Employee Data
                            <a href="{{ route('employees.create') }}" class="btn btn-primary float-end">Add Employee</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div>
                            <form action="{{ route('employees.search') }}" method="GET">
                                <div class="input-group mb-3">
                                    <input type="search" name="emp_search" class="form-control" placeholder="Enter employee username or email">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </button>
                                        <a href="{{ route('employees.index') }}" class="btn btn-warning text-white">
                                            <i class="fa fa-refresh" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-responsive">
                                <thead>
                                  <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Designation</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                  </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    @if(!empty($employee) && $employee->count())
                                        @foreach ($employee as $empdata)
                                            <tr>
                                                <th>{{ $empdata->id }}</th>
                                                <td>{{ $empdata->name }}</td>
                                                <td>{{ $empdata->email }}</td>
                                                <td>{{ $empdata->phone }}</td>
                                                <td>{{ $empdata->designation }}</td>
                                                <td>{{ $empdata->status }}</td>
                                                <td>
                                                    <a href="{{ route('employees.edit', $empdata->id) }}" class="btn btn-primary">Edit</a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('employees.destroy', $empdata->id) }}" class="btn btn-danger" 
                                                       onclick="return confirm('Are you sure to delete {{ $empdata->name }} data?')">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8">There are no data</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4 float-end">
            {{ $employee->links() }}
        </div>
    </div>   
@endsection
                                        