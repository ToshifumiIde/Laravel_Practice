<?php

namespace App\MyClasses;

// 2-1 サービスコンテナと結合
// class MyService {
//     // IDの値を引数としてインスタンスを生成する場合
//     private $id = -1;
//     private $msg = "no id...";
//     private $data = ["hello" , "Welcome" ,"Bye"];

//     public function __construct(int $id = -1) {
//         if($id > 0){
//             $this->id = $id;
//         }
//         $this->msg = "Hello! This is MyService";
//         $this->data = ["Hello", "Welcome", "Bye"];
//     }
//     public function say() {
//         return $this->msg;
//     }
//     public function data() {
//         return $this->data;
//     }
// }


//IDの値を引数として渡してインスタンスを生成する場合の処理
// class MyService {
//     private $id = -1;
//     private $msg = "no id...";
//     private $data = ["Hello", "Welcome", "Bye"];

//     public function __construct(int $id = -1) {
//         if ($id >= 0) {
//             $this->id = $id;
//             $this->msg = "select :" . $this->data[$id];
//         }
//     }

//     public function say() {
//         return $this->msg;
//     }
//     public function data(int $id) {
//         return $this->data[$id];
//     }

//     public function allData() {
//         return $this->data;
//     }
// }


// サービスコンテナの結合（インスタンスへの組み込み処理を明示化）を行う場合
// app()->bind("クラス名" , function(){ ...処理... ; return インスタンス});とする
// 作成したサービスコンテナはプロバイダで結合する（/app/Providers/AppServiceProvider.phpでapp()->bind()を実行）
// class MyService {
//     private $id   = -1;
//     private $msg  = "no id ...";
//     private $data = ["Hello", "Welcome", "Bye"];

//     public function __construct() {
//     }

//     public function setId($id) {
//         $this->id = $id;
//         if ($id >= 0 && $id < count($this->data)) {
//             $this->msg = "select id :" . $id . ', data :"' . $this->data[$id] . '"';
//         }
//     }

//     public function say() {
//         return $this->msg;
//     }

//     public function data(int $id) {
//         return $this->data[$id];
//     }

//     public function allData() {
//         return $this->data;
//     }
// }

// 2-1 サービスコンテナと結合 シングルトン = 常に同じインスタンスが得られる様にする
// class MyService {
//     private $myservice;
//     private $id   = -1;
//     private $msg  = "no id ...";
//     private $data = ["Hello" , "Welcome" ,"Bye"];

//     private function __construct() {
//     }

//     public static function getInstance() {
//         return self::$myservice ?? self::$myservice = new MyService();
//     }

//     public function setId($id){
//         $this->id = $id;
//         if($id >=0 && $id < count($this->data)){
//             $this->msg = 'select id is :' . $id . ', data :"' . $this->data[$id] . '"';
//         }
//     }

//     public function say(){
//         return $this->msg;
//     }

//     public function data($id){
//         return $this->data[$id];
//     }

//     public function allData(){
//         return $this->data;
//     }
// }

// MyServiceをシングルトンで結合する（設定前はMyServiceは3回呼び出されている）
// class MyService {
//     private $serial;
//     private $id   = -1;
//     private $msg  = "no id ...";
//     private $data = ["Hello", "Welcome", "Bye"];

//     // MyServiceクラスの呼び出し確認用の__construct()メソッド
//     // function __construct() {
//     //     $this->serial = rand();
//     //     echo "「" . $this->serial . "」";
//     // }

//     // 引数を渡して結合する場合
//     function __construct(int $id) {
//         $this->setId($id);
//         $this->serial = rand();
//         echo "「" . $this->serial . "」";
//     }


//     public function setId($id) {
//         $this->id = $id;
//         if ($id >= 0 && $id < count($this->data)) {
//             $this->msg = 'select id is :' . $id . ', data :"' . $this->data[$id] . '"';
//         }
//     }

//     public function say() {
//         return $this->msg;
//     }

//     public function data($id) {
//         return $this->data[$id];
//     }

//     public function allData() {
//         return $this->data;
//     }
// }

class MyService implements MyServiceInterface {
    private $serial;
    private $id   = -1;
    private $msg  = "no id ...";
    private $data = ["Hello", "Welcome", "Bye"];


    // 引数を渡して結合する場合
    // function __construct(int $id) {
    //     $this->setId($id);
    //     $this->serial = rand();
    //     echo "「" . $this->serial . "」";
    // }


    public function setId($id) {
        $this->id = $id;
        if ($id >= 0 && $id < count($this->data)) {
            $this->msg = 'select id is :' . $id . ', data :"' . $this->data[$id] . '"';
        }
    }

    public function say() {
        return $this->msg;
    }

    public function data($id) {
        return $this->data[$id];
    }

    public function allData() {
        return $this->data;
    }
}
