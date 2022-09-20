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
                        <h4>Users Data
                            <a href="{{ url('add-user') }}" class="btn btn-primary float-end">Add User</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div>
                            <form action="{{ url('search-employee') }}" method="GET">
                                <div class="input-group mb-3">
                                    <input type="search " name="emp_search" class="form-control" placeholder="Enter employee username or email">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <table class="table">
                            <thead>
                              <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Phone</th>
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
                                            <td>{{ $empdata->last_name }}</td>
                                            <td>{{ $empdata->email }}</td>
                                            <td>{{ $empdata->phone }}</td>
                                            <td>
                                                <a href="{{ url('edit-user/'.$empdata->id) }}" class="btn btn-primary">Edit</a>
                                            </td>
                                            <td>
                                                <a href="{{ url('delete-user/'.$empdata->id) }}" class="btn btn-danger">Delete</a>
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
        <div class="row mt-4 float-end">
            {{ $employee->onEachSide(5)->links() }}
        </div>
    </div>   
@endsection
                                        