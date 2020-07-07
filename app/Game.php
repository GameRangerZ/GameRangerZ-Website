<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Eloquent;

/**
 * Highscore
 *
 * @mixin Eloquent
 */
class Game extends Model
{
    protected $fillable = [
        'name'
    ];
}
