@extends('layouts.app')

@section('content')
<div class="container">
    @if(Auth::check() || $user->is_blocked)
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
    <ul class="nav navbar-nav navbar-right">
        @if (Auth::guest())
            <li><a href="{{ url('/auth/login') }}">Login</a></li>
            <li><a href="{{ url('/auth/register') }}">Register</a></li>
        @else
            <div class="card-body">
                <div class="col-md-12 text-center">
                    <a href="{{route('logout')}}">Logout</a>
                </div>
            </div>
        @endif
    </ul>
    @else
        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>
    @endif
</div>
@endsection
