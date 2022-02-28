<?php

namespace App\Listeners;

use App\Events\PersonEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Person;
use Illuminate\Support\Facades\Storage;

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
     * @param  \App\Events\PersonEvent  $event
     * @return void
     */
    public function handle(PersonEvent $event) {
        Storage::append("person_access_log.txt", '[PersonEvent]' . now() . "" . $event->person->all_data);
    }
}
