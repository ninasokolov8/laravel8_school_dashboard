@extends('layouts.dashboard')

@section('content')

    @if(!empty($message))
    <div>
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
    </div>
    @endif
    <div  class="container pt-5"><a href="{{ route('user.create') }}">Create user +</a></div>

    <div class="container pt-5">
        <div class="row justify-content-center">
        <table class="table">
            <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">User Name</th>
                <th class="text-center">Email</th>
                <th class="text-center">Edit</th>


            </tr>
            </thead>
            @foreach($users as $user)
                <tbody>

                <tr>
                    <td class="text-center">{{$user->id}}</td>
                    <td class="text-center">{{$user->username}}</td>
                    <td class="text-center">{{$user->email}}</td>
                    <td class="text-center"><a href="{{ route('user.edit',[$user->id]) }}">Edit User</a></td>

                </tr>
                </tbody>
            @endforeach
        </table>


           {{ $users->links("pagination::bootstrap-4") }}


       </div>
    </div>

@endsection
