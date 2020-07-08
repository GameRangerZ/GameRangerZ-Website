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
                        <div class="alert alert-danger" role="alert">
                            <i class="fa fa-times fa-lg"></i> Ich konnte dich leider nicht auf Teamspeak finden...
                            <strong>Bist du eingeloggt?</strong>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <a href="{{route('auth.teamspeak')}}" class="btn btn-success">
                            {{ __('Retry') }}
                        </a>
                        <a href="{{route('dashboard')}}" class="btn btn-danger float-md-right">
                            {{ __('Abort') }}
                        </a>
                    </div>
                </div>
                <div class="row mt-5 card">
                    <div class="card-header">Manuelle Auswahl</div>
                    <div class="col-md-12 pt-2 pb-2">
                        <i>Solltest du dennoch auf dem TeamSpeak sein, kannst du dich unten aus der Liste auswählen.</i>
                        <form method="POST" action="{{ route('auth.teamspeak.submit') }}">
                            @csrf
                            <div class="form-group mt-3">
                                <label for="client">Clientliste</label>
                                <select name="client" id="client" class="form-control">
                                    @foreach ($clients as $client)
                                        <option value="{{$client->clid}}">{{ $client->client_nickname}}
                                            - {{$client->connection_client_ip}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                {{ __('Submit') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
