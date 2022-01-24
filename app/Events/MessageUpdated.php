<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $text;
    public $userId;
    public $itemId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($text, $userId, $itemId)
    {
        $this->text = $text;
        $this->userId = $userId;
        $this->itemId = $itemId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('my-channel-update');
    }

    public function broadcastAs()
    {
        return 'message-updated';
    }
}
