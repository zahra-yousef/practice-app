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
                            <a href="{{ url('add-employee') }}" class="btn btn-primary float-end">Add Employee</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
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
                                @foreach ($employee as $empdata)
                                    <tr>
                                        <th>{{ $empdata->id }}</th>
                                        <td>{{ $empdata->name }}</td>
                                        <td>{{ $empdata->email }}</td>
                                        <td>{{ $empdata->phone }}</td>
                                        <td>{{ $empdata->designation }}</td>
                                        <td>{{ $empdata->status }}</td>
                                        <td>
                                            <a href="{{ url('edit-employee/'.$empdata->id) }}" class="btn btn-primary">Edit</a>
                                        </td>
                                        <td>
                                            <a href="{{ url('delete-employee/'.$empdata->id) }}" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
                                        