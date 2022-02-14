<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Person;
// 1-3ファイルの読み込みを実行する際は以下のuse文を追加
use Illuminate\Support\Facades\Storage;

class HelloController extends Controller {

    // 1-3 ファイルアクセスで使用（HelloController内でのみ使用可能なプライベート変数、取り出しは$this->fname）
    private $fname;

    // __construct(){}メソッドは全てのアクションの前に必ず実行されるメソッド
    public function __construct() {
        // 1-2 config()を用いた内容の上書き
        // ここにconfig(sample.message)を描くことで、config/sample.phpのmessageの内容を上書き
        // config(["sample.message" => "config()で変更した新しいメッセージ!",]);

        //  1-3 fileSystemのファイル読み込み（ファイル名の設定）__construct内で実行されているため、全actionに適用される
        // $this->fname = "sample.txt";
        $this->fname = "hello.txt";
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
    // public function index() {
    // config()関数でconfigディレクトリ内の「ファイル.変数名」で呼び出しが可能
    // $sample_msg = config("sample.message");
    // $sample_data = config("sample.data");
    // $app_name = config("app.name");

    // 1-2env()を用いて.envファイルの環境変数を取り出し
    // $sample_msg = env("SAMPLE_MESSAGE");
    // $sample_data = env("SAMPLE_DATA");
    // $data = [
    //     "msg" => $sample_msg,
    //     // "data" => $sample_data,
    //     // "name" => $app_name,
    //     //  1-2 env()関数を用いて.envファイルから環境変数を取り出す。
    //     // env関数で得られる値は文字列となるため、配列として取り出す場合explode関数などを用いて配列に直す必要がある
    //     "data" => explode(",", $sample_data),
    // ];
    // return view("hello.index", $data);
    // }

    // 1-3 fileアクセスの実際
    // public function index() {
    //     // $sample_msg  = $this->frame;
    //     // $sample_data = Storage::get($sample_msg);
    //     // $data = [
    //     //     "msg"  => $sample_msg,
    //     //     "data" => explode(PHP_EOL, $sample_data),
    //     // ];
    //     // return view("hello.index", $data);

    //     // Storage::disk("")を用いて、publicディレクトリ内のhello.txtの中身を取得する
    //     $sample_msg  = Storage::disk("public")->url($this->frame);
    //     $sample_data = Storage::disk("public")->get($this->frame);
    //     $data = [
    //         "msg" => $sample_msg,
    //         "data" => explode(PHP_EOL, $sample_data),
    //     ];
    //     return view("hello.index", $data);
    // }
    // 1-3 public function index(){}の中身にStorage::url()、Storage::size()、Storage::lastModified()で取得できる値を表示
    // public function index() {
    // Storage::url()、Storage::size()、Storage::lastModified()の使用例
    // $url           = Storage::disk("public")->url($this->fname);
    // $size          = Storage::disk("public")->size($this->fname);
    // $modified      = Storage::disk("public")->lastModified($this->fname);
    // $modified_time = date("y-m-d H:i:s", $modified);
    // $sample_keys   = ["url", "size", "modified"];
    // $sample_meta   = [$url, $size, $modified_time];
    // $result        = "<table><tr><th>" . implode("</th><th>", $sample_keys) . "</th></tr>";
    // $result       .= "<tr><td>" . implode("</td><td>", $sample_meta) . "</td></tr></table>";
    // $sample_data   = Storage::disk("public")->get($this->fname);
    // $data = [
    //     "msg"  => $result,
    //     "data" => explode(PHP_EOL, $sample_data),
    // ];
    // return view("hello.index", $data);

    // storage内のファイル一覧を表示する
    // $dir = "/";
    // $all = Storage::disk("mac")->allFiles($dir);
    // $data = [
    // "msg" => "DIR :" . $dir,
    // "data" => $all,
    // ];
    // return view("hello.index", $data);
    // }

    // 1-4 request response
    // public function index(Request $request) {
    //     // $msg = "please input text";
    //     // // $request->isMethod()を用いた条件分岐
    //     // if ($request->isMethod("post")) {
    //     //     // $request->msgでも$request->input(”msg")でも同じ内容を取得可能
    //     //     $msg = "You typed : '" . $request->input("msg") . "'";
    //     // }
    //     // $data = [
    //     //     "msg" => $msg,
    //     // ];
    //     // return view("hello.index", $data);

    //     // ユーザーが入力した$requestを全件取得する
    //     // 初期値
    //     $msg    = "please input text :";
    //     $keys   = [];
    //     $values = [];
    //     // $request->isMethod()で条件分岐
    //     if ($request->isMethod("post")) {
    //         $form   = $request->all();      //$request->all()で全件を配列で取得
    //         $keys   = array_keys($form);    //$request->all()->array_keys()で配列のキーを配列で取得
    //         $values = array_values($form);  //$request->all()->array_values()で配列の値を配列で取得
    //     }
    //     $data = [
    //         "msg"    => $msg,
    //         "keys"   => $keys,
    //         "values" => $values,
    //     ];
    //     return view("hello.index", $data);
    // }

    // 1-4 request and responseの両方を使用して全件取得した内容を反映する
    // public function index(Request $request, Response $response) {
    //     $msg = "please input text :";
    //     $keys = [];
    //     $values = [];
    //     if ($request->isMethod("post")) {
    //         $form = $request->all();
    //         $result = '<html><body>';
    //         foreach ($form as $key => $value) {
    //             $result .= $key . ':' . $value . "<br>";
    //         }
    //         $result .= "<body></html>";
    //         //コントローラーのアクションメソッドは「Responseを返り値に持つ」
    //         // setContent()メソッドで$resultの値をコンテンツとして設定、それをreturnすることで、コンテンツがクライアントに送信される
    //         $response->setContent($result);
    //         return $response;
    //     }
    //     $data = [
    //         "msg"    => $msg,
    //         "keys"   => $keys,
    //         "values" => $values,
    //     ];
    //     return view("hello.index" , $data);
    // }
    // 1-4 必要な項目だけ抽出してrequestとresponseに利用する$request->only()の使用
    // $request->only()の引数は配列、配列に指定した値のみ取得可能となる
    // 指定しなかったname属性は、項目そのものが用意されなくなる
    // 主要な用途としては"_token"(@csrfで生成されるtokenのname属性)を取り除いた配列を指定し、ユーザーから入力された情報は受け取る方法
    // public function index(Request $request, Response $response) {
    //     $msg    = "please input text :";
    //     $keys   = [];
    //     $values = [];
    //     if ($request->isMethod("post")) {
    //         $form   = $request->only(["name", "mail",]);
    //         // $form   = $request->all(); //全件取得する場合は$request->all()で取得可能
    //         $keys   = array_keys($form);
    //         $values = array_values($form);
    //         $data   = [
    //             "msg"    => "you inputted .",
    //             "keys"   => $keys,
    //             "values" => $values,
    //         ];
    //         return view("hello.index", $data);
    //     }
    //     $data = [
    //         "msg"    => $msg,
    //         "keys"   => $keys,
    //         "values" => $values,
    //     ];
    //     return view("hello.index", $data);
    // }
    // old()メソッドとflash()メソッド(次のユーザーリクエストの間だけセッションに保持されるデータ)
    // public function index(Request $request, Response $response) {
    //     $msg    = "please input text :";
    //     $keys   = [];
    //     $values = [];
    //     if ($request->isMethod("post")) {
    //         $form   = $request->only(["name", "mail", "tel"]);
    //         $keys   = array_keys($form);
    //         $values = array_values($form);
    //         $msg    = old("name") . ',' . old("mail") . ',' . old("tel");
    //     }
    //     $data = [
    //         "msg" => $msg,
    //         "keys" => $keys,
    //         "values" => $values,
    //     ];
    //     $request->flash();
    //     return view("hello.index", $data);
    // }

    // クエリパラメータの利用
    // public function index(Request $request, Response $response) {
    //     $name   = $request->query("name");
    //     $mail   = $request->query("mail");
    //     $tel    = $request->query("tel");
    //     $msg    = $name . "," .  $mail . "," . $tel;
    //     $keys   = ["名前", "メール", "電話",];
    //     $values = [$name, $mail, $tel];
    //     $data   = [
    //         "msg"    => $msg,
    //         "keys"   => $keys,
    //         "values" => $values,
    //     ];
    //     $request->flash();
    //     return view("hello.index", $data);
    // }

    // クエリパラメータのテキストを利用して特定のルートにリダイレクトする
    public function index(Request $request, Response $response) {
        $name = $request->query("name");
        $mail = $request->query("mail");
        $tel  = $request->query("tel");
        $msg = $request->query("msg");
        $keys = ["名前", "メール", "電話"];
        $values = [$name, $mail, $tel];
        $data = [
            "msg" => $msg,
            "keys" => $keys,
            "values" => $values,
        ];
        $request->flash();
        return view("hello.index", $data);
    }


    // 1-2 config sampleにリダイレクト
    // public function other(Request $request) {
    //     $data = [
    //         "msg" => $request->bye,
    //     ];
    //     // return redirect()->route("hello");
    //     // return view("hello.index", $data);
    //     return redirect()->route("sample");
    // }

    // 1-3 fileアクセス
    // public function other($msg) {
    //     $data = Storage::get($this->fname) . PHP_EOL . $msg;
    //     Storage::put($this->fname, $data);
    //     return redirect()->route("hello");
    // }
    // 1-3 fileへの追記(appendとprepend)
    // public function other(Request $request) {
        // sample.txtの末尾に$msgを追記する場合append()を使用
        // Storage::append($this->fname , $msg);

        // Storage::prepend()でsample.txtの先頭に直接追記
        // Storage::prepend($this->fname , $msg);
        // return redirect()->route("hello");

        // Storage::disk()とprepend()を用いて、publicディレクトリ$this->fnameの中身を変更
        // Storage::disk("public")->prepend($this->fname, $msg);
        // Storage::disk("public")->append($this->fname, $msg);
        // return redirect()->route("hello");

        // Storage::copy()、Storage::move()、Storage::delete()の使用
        // if (Storage::disk("public")->exists("bk_" . $this->fname)) {
        //     Storage::disk("public")->delete("bk_" . $this->fname);
        // }
        // Storage::disk("public")->copy($this->fname, "bk_" . $this->fname);
        // if (Storage::disk("local")->exists("bk_" . $this->fname)) {
        //     Storage::disk("local")->delete("public/bk_" . $this->fname, "bk_" . $this->fname);
        // }
        // Storage::disk("local")->move("public/bk_" . $this->fname, "bk_" . $this->fname);
        // return redirect()->route("hello");

        // ファイルダウンロードの実行Storage::disk("public")->download($this->fname)をリターンに返却する必要あり
        // これでotherアクションメソッドはダウンロード専用になる。
        // return Storage::disk("public")->download($this->fname);

        // ファイルアップロード（名前ランダム）を実行する場合、Storage::disk()->putFile()メソッドを使用すれば実行可能
        // Storage::disk("local")->putFile("files", $request->file);
        // return redirect()->route("hello");

        // 名称を指定してfileアップロードを実行する場合、putFileAs()メソッドを使用する
        // $ext = "." . $request->file("file")->extension();
        // Storage::disk("public")->putFileAs("files", $request->file("file"), "upload" . $ext);
        // return redirect()->route("hello");
    // }

    // 1-4 request and response
    public function other (){
        $data = [
            "name" => "taro",
            "mail" => "taro@yamada",
            "tel"  => "090-9999-9999",
        ];
        $query_string = http_build_query($data);
        $data ["msg"] = $query_string;
        return redirect()->route("hello" ,$data);
    }
}
