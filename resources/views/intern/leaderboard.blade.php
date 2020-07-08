<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<div class="card">
    <div class="card-body">
        <div class="d-flex flex-row justify-content-between">
            <h4 class="card-title mb-1">Leaderboard</h4>
            <p class="text-muted mb-1">Score</p>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="preview-list">
                    @foreach($highscore as $score)
                        <div class="preview-item border-bottom">
                            <div class="preview-thumbnail">
                                <div class="preview-icon">
                                    <img class="img-fluid rounded-circle" src="{{$score->user->avatar}}" alt="Avatar">
                                </div>
                            </div>
                            <div class="preview-item-content d-sm-flex flex-grow">
                                <div class="flex-grow">
                                    <h6 class="preview-subject">{{$score->user->username}}</h6>
                                </div>
                                <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                    <p class="text-muted">{{$score->score}}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
