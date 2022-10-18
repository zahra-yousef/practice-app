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
                    <div>
                        <form action="{{ route('posts.search') }}" method="GET">
                            <div class="input-group mb-3">
                                <input type="search" name="post_search" class="form-control" placeholder="Enter post title or description">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </button>
                                    <a href="{{ route('posts.index') }}" class="btn btn-warning text-white">
                                        <i class="fa fa-refresh" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
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
                                                    Visible
                                                @else
                                                    Hidden
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
    </div>
    <div class="row mt-4 float-end">
        {{ $post->links() }}
    </div>
</div>
@endsection
