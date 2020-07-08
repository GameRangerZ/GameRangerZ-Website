@extends('layouts.intern')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status')}}
                    </div>
                @endif
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-success" role="alert">
                            <i class="fa fa-check fa-lg"></i> Hab dich! Bist du
                            <strong>{{array_values($clients)[0]->client_nickname}}</strong>?
                        </div>
                    </div>
                    <div class="col-md-12">
                        <form method="POST" action="{{ route('auth.teamspeak.submit') }}">
                            @csrf
                            <input type="hidden" id="client" name="client" value="{{array_values($clients)[0]->clid}}">
                            <button type="submit" class="btn btn-success">
                                Ja, das bin ich!
                            </button>
                        </form>
                        <a href="{{route('dashboard')}}" class="btn btn-danger float-md-right">
                            {{ __('Abort') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
