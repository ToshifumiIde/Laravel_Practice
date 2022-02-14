<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;


class HelloController extends Controller {

    // __construct(){}メソッドは全てのアクションの前に必ず実行されるメソッド
    public function __construct() {
        // 1-2 config()を用いた内容の上書き
        // ここにconfig(sample.message)を描くことで、config/sample.phpのmessageの内容を上書き
        config(["sample.message" => "config()で変更した新しいメッセージ!",]);
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
        // $sample_msg = config("sample.message");
        // $sample_data = config("sample.data");
        // $app_name = config("app.name");

        // 1-2env()を用いて.envファイルの環境変数を取り出し
        $sample_msg = env("SAMPLE_MESSAGE");
        $sample_data = env("SAMPLE_DATA");
        $data = [
            "msg" => $sample_msg,
            // "data" => $sample_data,
            // "name" => $app_name,
            //  1-2 env()関数を用いて.envファイルから環境変数を取り出す。
            // env関数で得られる値は文字列となるため、配列として取り出す場合explode関数などを用いて配列に直す必要がある
            "data" => explode(",", $sample_data),
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
