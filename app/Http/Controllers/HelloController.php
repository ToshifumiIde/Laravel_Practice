<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;


class HelloController extends Controller {

    // __construct(){}メソッドは全てのアクションの前に必ず実行されるメソッド
    public function __construct()
    {
        // 1-2 config()を用いた内容の上書き
        // ここにconfig(sample.message)を描くことで、config/sample.phpのmessageの内容を上書き
        config(["sample.message" => "新しいメッセージ!",]);
    }
    // public function index(Request $request) {
    //     $data = [
    //         "msg" => $request->hello,
    //     ];
    //     return view("hello.index", $data);
    // }
    // 1-1 Person.phpの情報を取得
    // public function index(Person $person) {
    //     $data = ["msg" => $person,];
    //     return view("hello.index", $data);
    // }

    // 1-2 config/sample.phpから値を取得してviewに反映する
    public function index() {
        // config()関数でconfigディレクトリ内の「ファイル.変数名」で呼び出しが可能
        $sample_msg = config("sample.message");
        $sample_data = config("sample.data");
        // $app_name = config("app.name");
        $data = [
            "msg" => $sample_msg,
            "data" => $sample_data,
            // "name" => $app_name,
        ];
        return view("hello.index", $data);
    }


    public function other(Request $request) {
        $data = [
            "msg" => $request->bye,
        ];
        // return redirect()->route("hello");
        // return view("hello.index", $data);
        return redirect()->route("sample");
    }
}
