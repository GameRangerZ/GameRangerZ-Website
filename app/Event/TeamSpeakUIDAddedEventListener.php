<?php

namespace App\Event;

use App\Event\TeamSpeakUIDAddedEvent;
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
        $user = $sinusbot->getUserByName($event->user->username);
        $event->user->refresh();
        $sinusbot->editUser($user->uuid, null, $event->user->teamspeakuid, null, 61445);
    }
}
