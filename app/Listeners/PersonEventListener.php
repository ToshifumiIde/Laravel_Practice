<?php

namespace App\Listeners;

use App\Person; //追記
use App\Event\PersonEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage; //追加

class PersonEventListener {
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Event\PersonEvent  $event
     * @return void
     */
    public function handle(PersonEvent $event) {
        Storage::append("person_access_log.txt", "[PersonEvent]" . now() . "" . $event->person->all_data);
    }
}
