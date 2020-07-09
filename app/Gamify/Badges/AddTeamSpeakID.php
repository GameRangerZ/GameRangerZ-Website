<?php

namespace App\Gamify\Badges;

use QCod\Gamify\Badge;
use QCod\Gamify\BadgeType;

class AddTeamSpeakID extends BadgeType
{
    /**
     * name for badge
     *
     * @var string
     */
    protected $name = 'Connected!';

    /**
     * Description for badge
     *
     * @var string
     */
    protected $description = 'Füge deine TeamSpeak Identität deinem GameRangerZ Konto hinzu';

    /**
     * Check is user qualifies for badge
     *
     * @param $user
     * @return bool
     */
    public function qualifier($user)
    {
        if (empty($user->badges[0]) || !($user->badges->contains(Badge::firstwhere(['name' => $this->name])))) {
            if (!empty($user->teamspeakuid)) {
                session()->flash("achievement", $this->name);
            }
        }
        return !empty($user->teamspeakuid);
    }
}
