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
                        <a href="{{ route('posts.create') }}" class="btn btn-primary float-end">Add Post</a>
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
                            @if(!empty($post) && $post->count())
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
                                            <a href="{{ route('posts.edit', $item->id) }}" class="btn btn-primary">Edit</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('posts.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete this post ({{ $item->title }} )?')">Delete</button>
                                            </form>
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
        {{ $post->links() }}
    </div>
</div>
@endsection
