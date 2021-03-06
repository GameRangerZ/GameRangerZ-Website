<?php

namespace App\Event;

use App\Highscore;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewTetrisHighscoreEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $highscore;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Highscore $highscore)
    {
        $this->user = $user;
        $this->highscore = $highscore;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
