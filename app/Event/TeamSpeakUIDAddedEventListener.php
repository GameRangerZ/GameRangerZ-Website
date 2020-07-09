<?php

namespace App\Event;

use App\Event\TeamSpeakUIDAddedEvent;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use SinusBot\API;

class TeamSpeakUIDAddedEventListener
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
     * @param TeamSpeakUIDAddedEvent $event
     * @return void
     */
    public function handle(TeamSpeakUIDAddedEvent $event)
    {
        $sinusbot = new API(env("MUSICBOT_URI"));
        $sinusbot->login(env('MUSICBOT_USERNAME'), env('MUSICBOT_PASSWORD'));
        $sbuser = $sinusbot->getUserByName(strtolower($event->user->username));
        $event->user->refresh();
        $sbuser->setIdentity($event->user->teamspeakuid);
        $sbuser->setPrivileges(61445);
        $event->user->syncBadges();
    }
}
