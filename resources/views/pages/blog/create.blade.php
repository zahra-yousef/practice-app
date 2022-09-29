@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-4">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    Add Posts
                    <a href="{{ url()->previous() }}" class="btn btn-danger float-end">BACK</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="">Title</label>
                            <input 
                                type="text" 
                                name="title"
                                value="{{Request::old('title')}}"  
                                class="form-control is-valid @error('title') is-invalid @enderror" 
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
                                {{Request::old('description')}}
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
                            <input type="checkbox" name="status"> 0-show / 1-hide
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
