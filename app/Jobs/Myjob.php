<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
// use App\Models\Person;
use App\Person;

class Myjob implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $person;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Person $person) {
        $this->person = $person;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        //
        $sufix = '[+MYJOB]';
        if (strpos($this->person->name, $sufix)) {
            $this->person->name = str_replace($sufix, "", $this->person->name);
        } else {
            $this->person->name .= $sufix;
        }
        // echo '<p class="myjob">THIS IS MY JOB FROM Jobs</p>';
        $this->person->save();
    }
}
