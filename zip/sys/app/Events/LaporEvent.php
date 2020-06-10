<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class LaporEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $userIDs;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message, $userIDs = null)
    {
        $this->message = $message;
        $this->userIDs = $userIDs;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // return ['lapor-channel'];
        $channels = [];

          if ($this->userIDs == null) {
            $channels = ['lapor-channel'];
          }
          else {
            foreach($this->userIDs as $userID) {
              array_push($channels, 'lapor-channel.'.$userID);
            }
          }

          return $channels;
    }
}
