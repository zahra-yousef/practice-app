@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-4">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    <div>
                        <a href="{{ route('users.change-password', Auth::user()->id) }}" class="btn btn-warning text-white mt-3">Change Password</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
