<?php

namespace App\Http\Controllers;

use App\Facades\MyService;
use App\MyClasses\MyServiceInterface;
use App\Providers\MyServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    //     } else{
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

    // 最初のレコード取得DB::table()->first()
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

    // 指定IDのレコード取得DB::table("テーブル名")->find(条件)
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
    
}
