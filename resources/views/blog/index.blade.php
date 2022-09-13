@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-4 text-center">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4>Posts
                        <a href="{{ url('posts/create') }}" class="btn btn-primary float-end">Add Post</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>User</th>
                                <th>Title</th>
                                <th>Status</th>                       
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($post as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        <img src="{{ asset('uploads/blog/'.$item->image) }}" width="80px" height="80px" alt="Post Image">
                                    </td>
                                    <td>{{ $item->users->name }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>
                                        @if ($item->status == 1)
                                            Hidden
                                        @else
                                            Visible
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('posts/'.$item->id.'/edit') }}" class="btn btn-sm btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ url('posts/'.$item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</a>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-4 mt-4 float-end">
                {{ $post->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
