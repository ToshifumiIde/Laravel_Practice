<?php

namespace App\Http\Controllers\Sample;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SampleController extends Controller {
    public function index(Request $request) {
        // 1-1
        // $data = [
        //     "msg" => "SAMPLE-CONTROLLER-INDEX!",
        // ];
        // return view("hello.index", $data);
        // 1-2
        // HelloController内の__construct(){}メソッド内で定義したconfig(["sample.message" => "新しいメッセージ"]);
        // が引き継がれるか確認
        $sample_msg  = config("sample.message"); //結論：引き継がれない
        $sample_data = config("sample.data");
        $data = [
            "msg" => $sample_msg,
            "data" => $sample_data,
        ];

        return view("hello.index", $data);
    }

    public function other(Request $request) {
        $data = [
            "msg" => "SAMPLE-CONTROLLER-OTHER",
        ];
        return view("hello.index", $data);
    }
}
