<?php

namespace App\Providers;

use App\MyClasses\MyService;
use App\MyClasses\PowerMyService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    // public function boot() {
    //     // 1-2
    //     config([
    //         "sample.data" => ["こんにちは", "こんばんは", "さようなら"],
    //     ]);
    // }

    // 2-1 サービスコンテナと結合
    // MyClasses/MyService.phpで作成したサービスコンテナを、Providerで結合する
    // 結合する場合、app()->bind("クラス名" , function(){})を実行
    // public function boot (){
    //     app()->bind("App\MyClasses\MyService" , function($app){
    //         $myservice = new MyService();
    //         $myservice->setId(0);
    //         return $myservice;
    //     });
    // }


    // 2-1 サービスコンテナと結合
    // MyServiceをシングルトンで結合する前の挙動
    // public function boot() {
    //     app()->bind("App\MyClasses\MyService", function ($app) {
    //         $myservice = new MyService(); //ここで__construct()メソッドの呼び出し
    //         $myservice->setId(0);
    //         return $myservice;
    //     });
    // }
    // シングルトン結合を実施
    // public function boot() {
    //     app()->singleton("App\MyClasses\MyService", function ($app) {
    //         $myservice = new MyService();
    //         $myservice->setId(0);
    //         return $myservice;
    //     });
    // }

    // 引数を渡して結合する。needs('$id')の部分は''で囲わないとエラーが返る点に注意
    // public function boot() {
    //     app()->when("App\MyClasses\MyService")->needs('$id')->give(1);
    // }

    // 粗結合の実行
    // public function boot() {
    //     app()->bind("App\MyClasses\MyServiceInterface", "App\MyClasses\MyService");
    // }

    // 利用先をMyServiceからPowerMyServiceに変更
    // public function boot() {
    //     app()->bind("App\MyClasses\MyServiceInterface", "App\MyClasses\PowerMyService");
    // }

    // サービスの結合時にイベントを発生させる：app()->resolving()の滋養
    // 結合時に常に呼び出される場合：第一引数にクロージャーを指定
    // 結合時に呼び出されるクラスを指定する場合：第一引数にクラス、第二引数にクロージャーを指定
    // 最終的に粗結合させる
    // public function boot() {
        // app()->resolving(function ($obj, $app) {
        //     if (is_object($obj)) {
        //         echo get_class($obj) . "<br>";
        //     } else {
        //         echo $obj . "<br>";
        //     }
        // });
        // app()->resolving(PowerMyService::class, function ($obj, $app) {
        //     $newData = ["ハンバーグ", "カレーライス", "唐揚げ", "餃子",];
        //     $obj->setData($newData);
        //     $obj->setId(rand(0, count($newData)));
        // });
        // app()->singleton("App\MyClasses\MyServiceInterface", "App\MyClasses\PowerMyService");
    // }
}
