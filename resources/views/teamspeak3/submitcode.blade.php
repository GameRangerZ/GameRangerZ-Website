@extends('layouts.app')

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
                <div class="row card">
                    <div class="card-header">Verifizieren</div>
                    <div class="col-md-12 pt-2 pb-2">
                        <i>Gebe hier nun den Code aus der Nachricht des Bots ein!</i>
                        <form method="POST" action="{{ route('auth.teamspeak.verifycode') }}">
                            @csrf
                            <div class="form-group mt-3">
                                <label for="code">Code aus TeamSpeak</label>
                                <input id="code" class="form-control" type="text">
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
