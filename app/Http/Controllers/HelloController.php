<?php

namespace App\Http\Controllers;

use App\MyClasses\MyServiceInterface;
use Illuminate\Http\Request;

// 2-1 サービスコンテナと結合
// app/MyClassからMyServiceのインスタンスを取得して使用する
// use App\MyClasses\MyService;
use App\Providers\MyServiceProvider;
use App\Facades\MyService;

class HelloController extends Controller {

    // MyService $myserviceとすることでインスタンスを生成
    // public function index(MyService $myservice) {
    //     $data = [
    //         "msg" => $myservice->say(),
    //         "data" => $myservice->data(),
    //     ];
    //     return view("hello.index", $data);
    // }

    // 🌟app()関数を用いて明示的にインスタンスを生成する方法は次の通り🌟
    // public function index(Request $request) {
    //     $name = "default";
    //     $mail = "default mail";
    //     if($request->isMethod("post")){
    //         $name = $request->name;
    //         $mail = $request->mail;
    //     }
    //     $myservice = app("App\MyClasses\MyService");
    //     // なお、上記の取得方法は下記の3つでも同じ結果を得られる
    //     // $myservice = app("App\MyClasses\MyService");
    //     // $myservice = app()->make("App\MyClasses\MyService");
    //     // $myservice = resolve("App\MyClasses\MyService");
    //     // $csvController  = app()->make("App\csvClasses\CsvService");
    //     // このインスタンス生成を使えば、独自のアクションに引数を渡して対応が可能や！！
    //     $data = [
    //         "msg"  => $myservice->say(),  //クラス内のメソッドを呼び出し
    //         "data" => $myservice->data(), //クラス内のメソッドを呼び出し
    //         "name" => $name,
    //         "mail" => $mail,
    //     ];
    //     return view("hello.index", $data);
    // }

    // 2-1 サービスコンテナと結合
    // 🌟app()関数内でインスタンス生成時に引数を渡す場合、app()->makeWith()メソッドを使う🌟
    // 引数で渡す値は連想配列で渡す
    // public function index(Request $request, int $id = -1) {
    //     $myservice = app()->makeWith("App\MyClasses\MyService", ["id" => $id]);
    //     $data = [
    //         "msg" =>  $myservice->say(),
    //         "data" => $myservice->allData(),
    //     ];
    //     return view("hello.index", $data);
    // }

    // 2-1 サービスコンテナと結合
    // MyService.phpを明示的に、Providers/AppServiceProvider.phpでapp()->bind("クラス名" , function(){});と設定した内容の呼び出し
    // public function index(MyService $myservice, int $id = -1) {
    //     $myservice->setId($id);
    //     $data = [
    //         "msg"  => $myservice->say(),
    //         "data" => $myservice->allData(),
    //     ];
    //     return view("hello.index", $data);
    // }
    // 上記内容は以下に書き換えても実行する
    // アクションの引数に渡す代わりに、アクション内でapp()->make()で呼び出しても使用可能
    // public function index(int $id = -1) {
    //     $myservice = app()->make("App\MyClasses\MyService"); //🌟ここで呼び出し
    //     $myservice->setId($id);
    //     $data = [
    //         "msg"  => $myservice->say(),
    //         "data" => $myservice->allData(),
    //     ];
    //     return view("hello.index", $data);
    // }

    // （実行内容の記載忘れ）
    // function __construct(MyService $myService) {
    //     $myservice = app("App\MyClasses\MyService");
    //     // echo "HelloControllerの__construct()の呼び出し(MyServiceの呼び出し)";
    // }

    // public function index(MyService $myservice, int $id = -1) {
    //     $myservice->setId($id);
    //     // echo "MyServiceの呼び出し。";
    //     $data = [
    //         "msg"  => $myservice->say(),
    //         "data" => $myservice->allData(),
    //     ];
    //     return view("hello.index", $data);
    // }

    // 粗結合の実行
    // function __construct() {
    // }
    // public function index(MyServiceInterface $myservice, int $id = -1) {
    //     $myservice->setId($id);
    //     $data = [
    //         "msg"  => $myservice->say(),
    //         "data" => $myservice->allData(),
    //     ];
    //     return view("hello.index" , $data);
    // }

    // 登録したサービスプロバイダの利用
    // public function index(MyServiceInterface $myservice, int $id = -1) {
    //     $myservice->setId($id);
    //     $data = [
    //         "msg"  => $myservice->say(),
    //         "data" => $myservice->allData(),
    //     ];
    //     return view("hello.index", $data);
    // }

    // 登録したファサードの使用
    public function index(int $id = -1) {
        MyService::setId($id);
        $data = [
            "msg" => MyService::say(),
            "data" => MyService::allData(),
        ];
        return view("hello.index", $data);
    }
}
