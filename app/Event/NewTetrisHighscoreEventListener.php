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
            $client = TeamSpeak3::clientGetByUid($event->user->teamspeakuid);
            $AlreadySet = false;
            $sgmember = TeamSpeak3::serverGroupClientList(28);
            foreach ($sgmember as $member) {
                $member = TeamSpeak3::clientGetByUid($member['client_unique_identifier']);
                if ($client->client_database_id != $member->client_database_id) {
                    TeamSpeak3::serverGroupClientDel(28, $member->client_database_id);
                } else {
                    $AlreadySet = true;
                }
            }
            if (!$AlreadySet) {
                TeamSpeak3::serverGroupClientAdd(28, $client->client_database_id);
            }
        }
    }
}
