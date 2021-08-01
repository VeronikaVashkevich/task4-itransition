@extends('layouts.app')

@section('content')
    <div class="container">
        @if (Auth::guest())
        @else

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
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <form method="post">
                    @csrf
                    @method('POST')
                    <button formaction="/manage" type="submit" class="btn btn-danger" id="delete_all_selected">Delete Selected</button>
                    <button formaction="/block" type="submit" class="btn btn-danger" id="block_selected">Block selected</button>
                    <button formaction="/unblock" type="submit" class="btn btn-success" id="unblock_selected">Unblock selected</button>

                    <table class="table">
                        <thead>
                        <tr>
                            <th><input type="checkbox" id="check_all"></th>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Date of registration</th>
                            <th scope="col">Date of last login</th>
                            <th scope="col">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr id="userId{{$user->id}}">
                                <td><input type="checkbox" class="check_user" name="ids[]" value="{{$user->id}}"> </td>
                                <th scope="row">{{$user->id}}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->created_at}}</td>
                                <td>{{$user->date_of_last_login}}</td>
                                <td>@if($user->checkOnline())
                                        <span class="color-green font-size-12"><i class="demo-icon icon-circle"></i>
                                            {{ trans('Online') }}
                                        </span>
                                    @else
                                        <span class="color-red font-size-12"><i class="demo-icon icon-circle-empty"></i>
                                             {{ trans('Offline') }}
                                        </span>
                                    @endif</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </form>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
                <script>
                    $('#check_all').click(function () {
                        $('.check_user').prop('checked', $(this).prop('checked'));
                    })
                    $('.check_user').change(function () {
                        let total = $('.check_user').length;
                        let number = $('.check_user:checked').length;

                        if(total == number){
                            $('#check_all').prop('checked', true);
                        } else {
                            $('#check_all').prop('checked', false);
                        }
                    })
                    ,kj
                </script>
            </div>
        </div>
        @else
            <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>
        @endif
        @endif
    </div>
@endsection
