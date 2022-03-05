<?php

namespace App\Http\Controllers;

use App\Jobs\MyJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use App\Models\Person;
use App\Person;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;
use App\Events\PersonEvent;
use Illuminate\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\BufferedOutput as Buffered;

class HelloController extends Controller {
    // 5-1 Vue.jsの利用
    // public function index() {
    //     $data = [
    //         "msg" => "This is Vue.js application",
    //     ];
    //     return view("hello.index", $data);
    // }
    // public function json($id = -1) {
    //     if ($id == -1) {
    //         return Person::get()->toJson();
    //     } else {
    //         return Person::find($id)->toJson();
    //     }
    // }

    // 5-2 Reactの利用
    // public function index() {
    //     $result = Person::all();
    //     $data = [
    //         "msg" => "This is React application",
    //         "data" => $result,
    //     ];
    //     return view('hello.index', $data);
    // }

    // public function json($id = -1) {
    //     if ($id == -1) {
    //         return Person::all()->toJson();
    //     } else {
    //         return Person::find($id)->toJson();
    //     }
    // }

    // 7-1 Artisanコマンドの利用
    // public function index($id = -1) {
    //     if ($id > 0) {
    //         $msg = "id = " . $id;
    //         $result = [Person::find($id)];
    //     } else {
    //         $msg = "all people data";
    //         $result = Person::all();
    //     }
    //     $data = [
    //         "msg" => $msg,
    //         "data" => $result,
    //     ];

    //     // dump($data);
    //     // dd($data);
    //     return view("hello.index", $data);
    // }

    // 7-2 スクリプトからArtisanを使う
    public function clear() {
        Artisan::call("cache:clear");
        Artisan::call("event:clear");
        return redirect()->route("hello");
    }

    // public function index($id = -1) {
    //     $output = new Buffered;
    //     Artisan::call("route:list", [], $output);
    //     $msg = $output->fetch();
    //     $data = [
    //         "msg" => $msg,
    //     ];
    //     return view("hello.index", $data);
    // }

    // オプションの設定
    public function index($id = -1) {
        $opt = [
            "--method" => "get",
            "--path" => "hello",
            "--sort" => "uri",
            "--compact" => "null",
        ];
        $output = new Buffered;
        Artisan::call("route:list", $opt, $output);
        $msg = $output->fetch();
        $data = [
            "msg" => $msg,
        ];
        return view("hello.index", $data);
    }
}
