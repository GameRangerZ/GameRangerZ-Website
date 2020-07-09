<?php

namespace App\Gamify\Badges;

use App\Highscore;
use QCod\Gamify\Badge;
use QCod\Gamify\BadgeType;

class Tetrismeister extends BadgeType
{
    /**
     * name for badge
     *
     * @var string
     */
    protected $name = 'Meistertitel';

    /**
     * Description for badge
     *
     * @var string
     */
    protected $description = 'Werde zum Tetrismeister';

    /**
     * Check is user qualifies for badge
     *
     * @param $user
     * @return bool
     */
    public function qualifier($user)
    {
        if (empty($user->badges[0]) || !($user->badges->contains(Badge::firstwhere(['name' => $this->name])))) {
            if (!empty(Highscore::all()->max())) {
                if (Highscore::all()->max()->user_id == $user->id) {
                    session()->flash("achievement", $this->name);
                }
            }
        }
        if (!empty(Highscore::all()->max())) {
            return (Highscore::all()->max()->user_id == $user->id);
        } else {
            return false;
        }
    }
}
