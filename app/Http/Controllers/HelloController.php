<?php

namespace App\Http\Controllers;

use App\Person;
use App\Jobs\Myjob;
use App\Facades\MyService;
use App\MyClasses\MyServiceInterface;
use App\Providers\MyServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Pagination\MyPaginator;
use Illuminate\Support\Facades\Storage;

class HelloController extends Controller {

    // 4-1 QueueとJob 基本的なQueueの処理
    // public function index(){
    //     Myjob::dispatch();
    //     $msg = "show people record";
    //     $result = Person::get();
    //     $data = [
    //         "msg" => $msg,
    //         "data" => $result,
    //     ];
    //     return view("hello.index" , $data);
    // }

    // 4-1 Queue
    // public function index(Person $person = null) {
    //     if ($person != null) {
    //         Myjob::dispatch($person);
    //     }
    //     $msg = "show people record: ";
    //     $result = Person::get();
    //     $data = [
    //         "input" => "",
    //         "msg" => $msg,
    //         "data" => $result,
    //     ];
    //     return view("hello.index", $data);
    // }

    // 4-1 Queueの遅延実行
    // public function index(Person $person = null) {
    //     if ($person != null) {
    //         // ここでdelay(now()->addMinutes())とすることで、dispatch($person)の
    //         // 実行タイミングを遅延させられる
    //         Myjob::dispatch($person)->delay(now()->addMinutes(1));
    //     }
    //     $msg    = "show people record: ";
    //     $result = Person::get();
    //     $data   = [
    //         "msg" => $msg,
    //         "data" => $result,
    //     ];
    //     return view("hello.index", $data);
    // }

    // Jobの実行指定(Queueを複数用意し、php artisan queue:work --stop-when-empty --queue=even,oddでqueueを実行させる)
    // public function index(Person $person = null) {
    //     if ($person != null) {
    //         $qname = $person->id % 2 == 0 ? "even" : "odd";
    //         Myjob::dispatch($person)->onQueue($qname);
    //     }
    //     $msg = "show people record: ";
    //     $result = Person::get();
    //     $data = [
    //         "msg" => $msg,
    //         "data" => $result,
    //     ];
    //     return view("hello.index",  $data);
    // }

    public function index() {
        $msg = "show people record: ";
        $result = Person::get();
        $data = [
            "input" => "",
            "msg" => $msg,
            "data" => $result,
        ];
        return view("hello.index", $data);
    }

    public function send(Request $request) {
        $id = $request->id; //ユーザーの入力したIDの取得
        $person = Person::find($id); //取得したIDでPerson::find($id)を用いてコレクション（モデルクラスのインスタンス）を取得
        // dd($person);
        dispatch(
            // コールバック関数内では、引数はuse("値")で取得する
            function () use ($person) {
                Storage::append("person_access_log.txt", $person->all_data);
            }
        );
        return redirect()->route("hello");
    }
}
