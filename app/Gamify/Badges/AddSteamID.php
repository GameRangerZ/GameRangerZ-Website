<?php

namespace App\Gamify\Badges;

use QCod\Gamify\Badge;
use QCod\Gamify\BadgeType;

class AddSteamID extends BadgeType
{
    /**
     * name for badge
     *
     * @var string
     */
    protected $name = 'Dampfbetrieben';

    /**
     * Description for badge
     *
     * @var string
     */
    protected $description = 'Füge deinen Steam Acocunt deinem GameRangerZ Konto hinzu';

    /**
     * Check is user qualifies for badge
     *
     * @param $user
     * @return bool
     */
    public function qualifier($user)
    {
        //Notification
        if (empty($user->badges[0]) || !($user->badges->contains(Badge::firstwhere(['name' => $this->name])))) {
            if (!empty($user->steamid)) {
                session()->flash("achievement", $this->name);
            }
        }
        return !empty($user->steamid);
    }
}
