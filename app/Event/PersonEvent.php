<?php

// 4-2 Event
namespace App\Event;

// 4-2 以下コメントアウトしている部分は、今回不要
// use Illuminate\Broadcasting\Channel;
// use Illuminate\Broadcasting\InteractsWithSockets;
// use Illuminate\Broadcasting\PresenceChannel;
// use Illuminate\Broadcasting\PrivateChannel;
// use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
// use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Person; //追記

class PersonEvent {
    // use Dispatchable, InteractsWithSockets, SerializesModels;
    use SerializesModels;

    public $person;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Person $person) {
        //
        $this->person = $person;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn() {
        return new PrivateChannel('channel-name');
    }
}