@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
        </div>
        <div class="col-md-8">
            <table class="table table-dark">
                <tbody>
                    <tr>
                        <td>Benutzername</td>
                        <td>{{$user->username}}</td>
                    </tr>
                    <tr>
                        <td>TeamSpeak ID</td>
                        <td>{{$user->TS3UID}}</td>
                    </tr>
                    <tr>
                        <td>Steam Account</td>
                        <td>
                            {{$user->steamid}}
                            @empty($user->steamid)
                                <a href="/auth/steam">Mit Steam verbinden...</a>
                            @endempty
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Sidebar</div>

                <div class="card-body">
                    Content
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
