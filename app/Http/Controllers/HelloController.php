<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;

class HelloController extends Controller {
    // public function index(Request $request) {
    //     $data = [
    //         "msg" => $request->hello,
    //     ];
    //     return view("hello.index", $data);
    // }
    // 1-1 Person.phpの情報を取得
    public function index(Person $person) {
        $data = ["msg" => $person,];
        return view("hello.index", $data);
    }

    public function other(Request $request) {
        $data = [
            "msg" => $request->bye,
        ];
        // return redirect()->route("hello");
        return view("hello.index", $data);
    }
}
