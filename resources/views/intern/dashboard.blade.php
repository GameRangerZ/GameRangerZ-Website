@extends('layouts.intern')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('flash-message')
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row justify-content-between">
                        <h4 class="display-5 mb-1">Moin {{$user->username}},</h4>
                    </div>
                    <p class="mt-3">
                        aktuell ist das GameRangerZ-Dashboard noch in Entwicklung. Danke das du so früh dabei bist!
                    </p>
                    <p>Aktuell genießt du folgende Vorteile:</p>
                    <ul>
                        <li>Deine eigene GameRangerZ-Email ({{$user->username}}@gamerangerz.de)</li>
                        <li>Nutzungsrechte für den Musicbot</li>
                        <li>Eine Chance auf den Titel "Tetrismeister"</li>
                        <li>Achievements</li>
                    </ul>
                    <p>Geplante Features:</p>
                    <ul>
                        <li>TeamSpeak Statistiken</li>
                        <li>TeamSpeak Gruppenverwaltung</li>
                        <li>Ein weiteres Spiel inkl. Titel</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row justify-content-between">
                        <h4 class="card-title mb-1">Dein Account</h4>
                        <p class="text-muted mb-1">Status</p>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="preview-list">
                                <div class="preview-item border-bottom">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle">
                                            <i class="mdi mdi-steam"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content d-sm-flex flex-grow">
                                        <div class="flex-grow">
                                            <h6 class="preview-subject">Steam Verbindung</h6>
                                            <p class="text-muted mb-0">{{$user->steamid}}</p>
                                        </div>
                                        <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                            @empty($user->steamid)
                                                <a href="{{ route('auth.steam') }}">Mit Steam verbinden...</a>
                                            @else
                                                <i class="mdi mdi-24px mdi-check text-success"></i>
                                            @endempty
                                        </div>
                                    </div>
                                </div>
                                <div class="preview-item border-bottom">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-primary rounded-circle">
                                            <i class="mdi mdi-headset"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content d-sm-flex flex-grow">
                                        <div class="flex-grow">
                                            <h6 class="preview-subject">TeamSpeak Verbindung</h6>
                                            <p class="text-muted mb-0">{{$user->teamspeakuid}}</p>
                                        </div>
                                        <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                            @empty($user->teamspeakuid)
                                                <a href="{{ route('auth.teamspeak') }}">Mit TeamSpeak verbinden...</a>
                                            @else
                                                <i class="mdi mdi-24px mdi-check text-success"></i>
                                            @endempty
                                        </div>
                                    </div>
                                </div>
                                <div class="preview-item border-bottom">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-info rounded-circle">
                                            <i class="mdi mdi-mail"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content d-sm-flex flex-grow">
                                        <div class="flex-grow">
                                            <h6 class="preview-subject">Primäre Email</h6>
                                            <p class="text-muted mb-0">@empty($user->email_verified_at)Bitte bestätige
                                                deine Email: @endempty{{$user->email}}</p>
                                        </div>
                                        <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                            @empty($user->email_verified_at)
                                                <i class="mdi mdi-24px mdi-alert text-danger text-center"></i>
                                            @else
                                                <i class="mdi mdi-24px mdi-check text-success"></i>
                                            @endempty
                                        </div>
                                    </div>
                                </div>
                                <div class="preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-danger rounded-circle">
                                            <i class="mdi mdi-mailbox"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content d-sm-flex flex-grow">
                                        <div class="flex-grow">
                                            <h6 class="preview-subject">Deine GameRangerz Email</h6>
                                            <p class="text-muted mb-0">{{$user->username}}@gamerangerz.de</p>
                                        </div>
                                        <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                            <i class="mdi mdi-24px mdi-check text-success"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
