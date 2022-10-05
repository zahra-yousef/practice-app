@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-4">
            <div class="card">
                <div class="card-header">
                    Edit Posts
                    <a href="{{ route('posts.index') }}" class="btn btn-danger float-end">BACK</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="">Title</label>
                            <input type="text" 
                                name="title" 
                                value="{{ $post->title }}"
                                class="form-control  is-valid @error('title') is-invalid @enderror" 
                            >
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Description</label>
                            <textarea 
                                name="description" 
                                rows="3"
                                class="form-control is-valid @error('description') is-invalid @enderror"  
                            >
                                {!! $post->description !!}
                            </textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Image (File Upload)</label>
                            <input 
                                type="file" 
                                name="image" 
                                class="form-control is-valid @error('image') is-invalid @enderror" 
                            >
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Status</label>
                            <input 
                                type="checkbox" 
                                name="status" 
                                value="1"
                                {!! $post->status == 1 ? 'checked':'' !!}
                            > 0-hide / 1-show
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
