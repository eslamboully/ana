<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateBoard implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $board;

    public function __construct($board)
    {
        $this->board = $board;
    }

    public function broadcastOn()
    {
        return ['update-board-channel'];
    }

    public function broadcastAs()
    {
        return 'update-board-event';
    }
}
