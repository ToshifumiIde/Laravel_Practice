<?php

namespace App\Http\Controllers;

use App\Facades\MyService;
use App\MyClasses\MyServiceInterface;
use App\Providers\MyServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Pagination\MyPaginator;
use App\Person;

class HelloController extends Controller {
    // public function index() {
    //     $result = DB::table("people")->get();
    //     $data = [
    //         "msg" => "Database access.",
    //         "data" => $result,
    //     ];
    //     return view("hello.index", $data);
    // }

    // IDによるDBの取得条件の変更DB::table("テーブル名")->where("column" , "条件" , "値")->get();
    // public function index(int $id = -1) {
    //     if ($id >= 0) {
    //         $msg    = "get ID <=" . $id;
    //         $result = DB::table("people")->where("id", "<=", $id)->get();
    //     } else {
    //         $msg    = "get people records";
    //         $result = DB::table("people")->get();
    //     }
    //     $data = [
    //         "msg"  => $msg,
    //         "data" => $result,
    //     ];
    //     return view("hello.index", $data);
    // }

    // 曖昧検索(like)：ワイルドカードの使用(%)。where()メソッドの第三引数に%の文字列を渡す
    // public function index($id = -1) {
    //     if ($id >= 0) {
    //         $msg = "get name like '" . $id . "'";
    //         $result = DB::table("people")->where("name","like", "%" . $id . "%")->get();
    //     } else {
    //         $msg = "get people records.";
    //         $result = DB::table("people")->get();
    //     }
    //     $data = [
    //         "msg" => $msg,
    //         "data" => $result,
    //     ];
    //     return view("hello.index", $data);
    // }

    // whereRaw()の紹介（ただしsql文を直接記入するため、sqlインジェクションに注意）
    // '%文字列%' と「'」または「"」で囲う必要あり
    // whereRaw()を安全に使用する場合、
    // 「?(プレースホルダ)」を使用し、第二引数にプレースホルダのパラメータを渡すと良い
    // public function index($id = -1) {
    //     if ($id >= 0) {
    //         $msg = "get name like '" . $id . "'";
    //         $result = DB::table("people")->whereRaw("name like '%" . $id . "%'")->get();
    //         $result = DB::table("people")->whereRaw("name like ?" , ["%".$id. "%"] )->get();
    //     } else {
    //         $msg = "get people records.";
    //         $result = DB::table("people")->get();
    //     }
    //     $data = [
    //         "msg" => $msg,
    //         "data" => $result,
    //     ];
    //     return view("hello.index", $data);
    // }

    // 最初のレコード取得DB::table()->first(); この場合->get()メソッドにメソッドチェーンを渡す必要はない
    // public function index() {
    //     $msg    = "get people records.";
    //     $first  = DB::table("people")->first();
    //     $last   = DB::table("people")->orderBy("id", "desc")->first();
    //     $result = [$first, $last];
    //     $data   = [
    //         "msg" => $msg,
    //         "data" => $result,
    //     ];
    //     return view("hello.index", $data);
    // }

    // 指定IDのレコード取得DB::table("テーブル名")->find(条件); この場合も->get()メソッドに繋ぐ必要はない
    // public function index($id = -1) {
    //     if ($id >= 0) {
    //         $msg    = "get name like '" . $id . "'";
    //         $result = [DB::table("people")->find($id)]; //1つの要素のみ取得するため、ここでは配列形式[]にした
    //     } else {
    //         $msg    = "get people records .";
    //         $result = DB::table("people")->get();
    //     }
    //     $data = [
    //         "msg"  => $msg,
    //         "data" => $result,
    //     ];
    //     return view("hello.index", $data);
    // }

    // 指定フィールドだけを取得：pluck
    // public function index() {
    //     $name   = DB::table("people")->pluck("name"); //pluckの戻り値はコレクション
    //     $value  = $name->toArray();                   //ここで連想配列に変換(キーは0から開始する番号)
    //     $msg    = implode(",", $value);               //ここで,区切りの文字列に変更
    //     $result = DB::table("people")->get();         //tableの全情報を取得
    //     $data   = [
    //         "msg" => $msg,
    //         "data" => $result,
    //     ];
    //     // dd($name, $value, $msg, $result);
    //     return view("hello.index", $data);
    // }

    // chunkById()による分割取得
    // public function index() {
    //     $data   = ["msg" => "", "data" => []];
    //     $msg    = "get :";
    //     $result = [];
    //     DB::table("people")->chunkById(2, function ($items) use (&$msg, &$result) {
    //         // &は参照渡し、これを記入しないとクロージャー街の変数は別物として扱われる
    //         foreach ($items as $item) {
    //             $msg .= $item->id . " ";
    //             $result += array_merge($result, [$item]);
    //             break;  //chunkById(2,~)で2つずつ区切って、1つ目の処理が完了した時点でbreakすることで、偶数番目の処理を実行させない
    //         }
    //         return true;
    //     });
    //     $data = [
    //         "msg" => $msg,
    //         "data" => $result,
    //     ];
    //     return view("hello.index", $data);
    // }

    // orderBy と chunk の使用(別の基準でレコードを並び替えて分割処理したい場合、chunkを使用する)
    // chunkはorderByとセットで使用する必要がある
    // public function index() {
    //     $data   = ["msg" => "", "data" => []];
    //     $msg    = "get : ";
    //     $result = [];
    //     DB::table("people")->orderBy("name", "asc")->chunk(2, function ($items) use (&$msg, &$result) {
    //         // &は参照渡し
    //         foreach ($items as $item) {
    //             $msg .= $item->id . ":" . $item->name . " ";
    //             $result += array_merge($result, [$item]);
    //             break;
    //         }
    //         return true;
    //     });
    //     $data = [
    //         "msg" => $msg,
    //         "data" => $result,
    //     ];
    //     return view("hello.index", $data);
    // }

    // 一部だけ抜き出して処理する
    // (chunkとorderByの併用による条件設定：今回はパラメータに渡した数字番目のchunk処理を実行する)
    // public function index($id) {
    //     $data   = ["msg" => "", "data" => []];
    //     $msg    = "get : ";
    //     $result = []; // 結果格納用の空配列を設定
    //     $count  = 0;   // 初期値0
    //     DB::table("people")->chunkById(3, function ($items) use (&$msg, &$result, &$id, &$count) {
    //         // use(&$~~)の部分は参照渡し。use(&$~~)としない場合、関数外の変数を参照できない
    //         if ($count == $id) {
    //             foreach ($items as $item) {
    //                 $msg .= $item->id . ":" . $item->name . " ";
    //                 $result += array_merge($result, [$item]);
    //             }
    //             return false;
    //         }
    //         $count++;
    //         return true;
    //     });
    //     $data = [
    //         "msg"  => $msg,
    //         "data" => $result,
    //     ];
    //     return view("hello.index", $data);
    // }

    // whereでの条件設定
    // and条件：$result = DB::table("people")->where("id" , ">=" , 10)->where("id" , "<=" ,20)->get();    // 10~20の間
    // or条件： $result = DB::table("people")->where("id" , "<=" , 10)->orWhere("id" , ">=" , 20)->get(); // 10以下、または20以上

    // 2つの値の範囲の設定
    // public function index($id) {
    //     $ids    = explode(",", $id);
    //     // dd($ids); //[ 0 => "3", 1 => "5" ];
    //     $msg    = "get people.";
    //     $result = DB::table("people")
    //         ->whereBetween("id", $ids)
    //         ->get();
    //     $data   = [
    //         "msg"  => $msg,
    //         "data" => $result,
    //     ];
    //     return view("hello.index", $data);
    // }

    // 条件が複数にまたがる場合の検索値(whereIn , orWhereIn , whereNotIn , orWhereNotIn)
    // public function index($id) {
    //     $ids    = explode(",", $id);
    //     $msg    = "get people";
    //     $result = DB::table("people")->whereIn("id", $ids)->get();
    //     $data   = [
    //         "msg" => $msg,
    //         "data" => $result,
    //     ];
    //     return view("hello.index", $data);
    // }

    // nullのチェック(whereNull , orWhereNull , whereNotNull , orWhereNotNull)

    // 3-2 paginationの実行 ->paginate(1ページ辺りのレコード数 , フィールド , ページの名前 , 取得するページの番号)
    // public function index($id){
    //     $msg = "show page : " . $id;
    //     $result = DB::table("people")->paginate(3, ["*"] , "page" , $id);
    //     $data = [
    //         "msg" => $msg,
    //         "data" => $result,
    //     ];
    //     return view("hello.index" , $data);
    // }

    // ナビゲーションリンクの設置
    // public function index(Request $request) {
    //     $id = $request->query("page");
    //     $msg = "show page: " . $id;
    //     $result = DB::table("people")->paginate(3, ["*"], "page",  $id);
    //     $data = [
    //         "msg" => $msg,
    //         "data" => $result,
    //     ];
    //     return view("hello.index", $data);
    //     // （ペジネーションで使用するリンクのスタイルにbootstrapのものを適用する/bootstrap/app.phpに追記）
    // }

    // simplePaginate()の使用
    // public function index(Request $request) {
    //     $id = $request->query("page");
    //     $msg = "show page: " . $id;
    //     $result = DB::table("people")->simplePaginate(3);
    //     $data = [
    //         "msg" => $msg,
    //         "data" => $result,
    //     ];

    //     return view("hello.index", $data);
    // }

    // 3-2 自作したペジネーションの使用
    // public function index(Request $request) {
    //     $id     = $request->query("page"); //クエリパラメータに渡された?page=~の部分
    //     $msg    = "show page: " . $id;
    //     $result = Person::paginate(3);
    //     $paginator = new MyPaginator($result); //作成したクラスのインスタンス生成
    //     $data = [
    //         "msg" => $msg,
    //         "data" => $result,
    //         "paginator" => $paginator,
    //     ];
    //     return view("hello.index", $data);
    // }

    // 3-3 Eloquent モデルの基本形
    // public function index(Request $request){
    //     $msg = "show people records.";
    //     $result = Person::get(); //ここでModelのPersonのスコープ定義演算子,staticメソッドを用いてget()している
    //     // dd($result);
    //     $data = [
    //         "msg" => $msg,
    //         "data" => $result,
    //     ];

    //     return view("hello.index" , $data);
    // }

    // コレクション(Illuminate\Database\Eloquent名前空間にあるCollectionのインスタンス)の機能：rejectとfilter
    // public function index(Request $request) {
    //     $msg = "show people record";
    //     $result = Person::get();
    //     // Person::get()から取得するレコードを排除する(今回はreturn $person->age < 20;とし、未成年を除外するコード)
    //     $result = Person::get()->reject(function ($person) {
    //         return $person->age < 20;
    //     });
    //     // Person::get()から取得するレコードを選択する(以下の場合、20歳以下を取得する)
    //     $result = Person::get()->filter(function ($person) {
    //         return $person->age <= 20;
    //     });

    //     $data = [
    //         "msg" => $msg,
    //         "data" => $result,
    //     ];
    //     return view("hello.index", $data);
    // }

    // 差分を確認する->diff(引数は取得したインスタンス)
    // public function index(Request $request){
    //     $msg    = "show people record.";
    //     $result = Person::get()->filter(function($person){
    //         return $person->age < 50;
    //     });
    //     $result2 = Person::get()->filter(function($person){
    //         return $person->age >= 20;
    //     });
    //     // $result->diff($result2)とすることで、引数に該当しないデータを取得することが可能
    //     $result3 = $result->diff($result2);

    //     $data = [
    //         "msg" => $msg,
    //         "data" => $result3,
    //     ];
    //     return view("hello.index" , $data);
    // }

    // Person::get()->modelKeys()でテーブルのキーのみを取得
    // public function index(Request $request) {
    //     $msg  = "show people record.";
    //     $keys = Person::get()->modelKeys(); //テーブルのキーだけをまとめ、取り出すことが可能
    //     // array_filter()メソッドを使用して、IDが偶数のみ取得
    //     $even = array_filter($keys, function ($key) {
    //         return $key % 2 == 0;
    //     });
    //     $odd = array_filter($keys, function ($key) {
    //         return $key % 2 == 1;
    //     });
    //     $result = Person::get()->only($even);
    //     $result = Person::get()->only($odd);
    //     $data   = [
    //         "msg" => $msg,
    //         "data" => $result,
    //     ];
    //     return view("hello.index", $data);
    // }

    // コレクションの機能：mergeとunique
    public function index(Request $request) {
        $msg = "show people record";
        // 取得したレコードのidが偶数のレコードを取得
        $even = Person::get()->filter(function ($item) {
            return $item->id % 2 == 0;
        });
        // 取得したレコードからageが偶数のものを取得
        $even2 = Person::get()->filter(function ($item) {
            return $item->age % 2 == 0;
        });
        // $evenと$even2を統合したレコード
        $result = $even->merge($even2);
        $data = [
            "msg" => $msg,
            "data" => $result,
        ];
        return view("hello.index", $data);
    }
}
