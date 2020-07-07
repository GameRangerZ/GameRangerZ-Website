@extends('layouts.intern')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('flash-message')
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
        </div>
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row justify-content-between">
                        <h4 class="card-title mb-1">Dein Account</h4>
                        <p class="text-muted mb-1">Status</p>
                    </div>
                    <div class="row">
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
                                            <h6 class="preview-subject">Email</h6>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
