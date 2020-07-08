<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Eloquent;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Highscore
 *
 * @mixin Eloquent
 */
class Highscore extends Pivot
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'highscore';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
