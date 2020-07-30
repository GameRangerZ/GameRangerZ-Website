@extends('layouts.intern')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('flash-message')
        </div>
    </div>
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row justify-content-between">
                    <h4 class="card-title mb-1">Achievements</h4>
                    <p class="text-muted mb-1">Status</p>
                </div>
                <div class="row">
                    <div class="col-12">
                        @foreach($achievements as $achievement)
                            @if($user->badges->contains($achievement))
                                <div class="preview-list">
                                    <div class="preview-item border-bottom ">
                                        <div class="preview-thumbnail">
                                            <div class="preview-icon bg-warning">
                                                <i class="mdi mdi-trophy"></i>
                                            </div>
                                        </div>
                                        <div class="preview-item-content d-sm-flex flex-grow">
                                            <div class="flex-grow">
                                                <h6 class="preview-subject">{{$achievement->name}}</h6>
                                                <p class="text-muted mb-0">{{$achievement->description}}</p>
                                            </div>
                                            <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                                <p class="text-muted">Errungen am:</p>
                                                <p class="text-muted mb-0">
                                                    {{ $user->badges->where('id',$achievement->id)->first()->pivot
                                                        ->created_at->format('j.n.Y H:i')}}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="preview-list">
                                    <div class="preview-item border-bottom">
                                        <div class="preview-thumbnail">
                                            <div class="preview-icon bg-dark">
                                                <i class="mdi mdi-trophy"></i>
                                            </div>
                                        </div>
                                        <div class="preview-item-content d-sm-flex flex-grow">
                                            <div class="flex-grow">
                                                <h6 class="preview-subject">{{$achievement->name}}</h6>
                                                <p class="text-muted mb-0">{{$achievement->description}}</p>
                                            </div>
                                            <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                                <p class="text-muted"></p>
                                                <p class="text-muted mb-0">Noch nicht errungen</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
