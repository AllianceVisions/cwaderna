<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ChangeLocation implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $user_id;
    public $name;
    public $event_id; 
    public $latitude; 
    public $longitude; 
    public $alert_out_of_zone; 
    public $refresh; 

    public function __construct($data)
    {
        $this->user_id = $data['user_id'];
        $this->name = $data['name'];
        $this->event_id = $data['event_id']; 
        $this->latitude = $data['latitude']; 
        $this->longitude = $data['longitude']; 
        $this->alert_out_of_zone = $data['alert_out_of_zone']; 
        $this->refresh = $data['refresh']; 
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['stream-location'];
    }

}
