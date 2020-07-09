<?php

namespace App\Event;

use App\Event\NewTetrisHighscoreEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\User;
use TeamSpeak3;

class NewTetrisHighscoreEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param NewTetrisHighscoreEvent $event
     * @return void
     */
    public function handle(NewTetrisHighscoreEvent $event)
    {
        if (isset($event->user->teamspeakuid)) {
            $clientID = TeamSpeak3::clientFindDb($event->user->teamspeakuid, true)[0];
            $AlreadySet = false;
            $sgmember = TeamSpeak3::serverGroupClientList(28);
            foreach ($sgmember as $member) {
                if ($clientID != $member["cldbid"]) {
                    TeamSpeak3::serverGroupClientDel(28, $member["cldbid"]);
                } else {
                    $AlreadySet = true;
                }
            }
            if (!$AlreadySet) {
                TeamSpeak3::serverGroupClientAdd(28, $clientID);
            }
        }
    }
}
