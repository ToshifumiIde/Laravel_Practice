<?php

namespace App\Http\Controllers;

use App\Jobs\MyJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use App\Models\Person;
use App\Person;
use Illuminate\Support\Facades\Storage;

use App\Events\PersonEvent;


class HelloController extends Controller {
    //
    // public function index(Person $person) {
    //     if ($person != null) {
    //         $qname = $person->id % 2 == 0 ? "even" : "odd";
    //         // MyJob::dispatch($person)->delay(now()->addMinutes(1));
    //         MyJob::dispatch($person)->onQueue($qname);
    //     }
    //     $result = Person::get();
    //     $msg = "this is message from HelloController index";
    //     $data = [
    //         "msg" => $msg,
    //         "data" => $result,
    //     ];
    //     return view("hello.index", $data);
    // }
    // public function post(Request $request) {
    //     $msg = "message from HelloController post";
    //     $id = $request->id;
    //     $result = Person::get();
    //     $data = [
    //         "msg" => $msg,
    //         "id" => $id,
    //         "data" => $result,
    //     ];
    //     return view("hello.index", $data);
    // }
    public function index() {
        $msg = "this is message from HelloController index";
        $result = Person::get();
        $data = [
            "input" => "",
            "msg" => $msg,
            "data" => $result,
        ];
        return view("hello.index", $data);
    }
    // public function send(Request $request) {
    //     $id = $request->id;
    //     $person = Person::find($id);
    //     // dd($person);
    //     dispatch(function () use ($person) {
    //         Storage::append('person_access_log.txt', $person->all_data);
    //         dd($person);
    //     });
    //     return redirect()->route("hello");
    // }

    // 4-2 Event
    public function send(Request $request) {
        $id = $request->id;
        $person = Person::find($id);
        event(new PersonEvent($person));
        $data = [
            "input" => "",
            "msg" => 'id=' . $id,
            "data" => [$person],
        ];
        return view("hello.index", $data);
    }
}
