<?php

namespace App\Jobs;

use App\Person;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class Myjob implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $person;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Person $person) {
        //
        $this->person = $person;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        //
        // echo '<p class="myjob">THIS IS MY JOB!!</p>';
        $sufix = '[+MYJOB]';
        if (strpos($this->person->name, $sufix)) {
            $this->person->name = str_replace($sufix, "", $this->person->name .= $sufix);
        } else {
            $this->person->name .= $sufix;
        }
        $this->person->save();
    }
}
