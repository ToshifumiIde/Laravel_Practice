<?php

namespace App\Listeners;

class MyEventSubscriber {
    public function subscribe($events) {
        $events->listen(
            "App\Events\PersonEvent",
            "App\Listeners\PersonEventListener@handle",
        );
    }
}
