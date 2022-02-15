<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// 2-2 facadesのサービスプロバイダの作成
// $ php artisan make:provider MyServiceProvider で作成された
class MyServiceProvider extends ServiceProvider {
    /**
     * Register services.
     * サービスの登録。ここでサービスプロバイダが使用するサービスクラスの登録などを行います。
     * @return void
     */
    // public function register() {
    //     app()->singleton("App\MyClasses\MyServiceInterface", "App\MyClasses\PowerMyService");
    //     echo "<b><MyServiceProvider/register></b><br>";
    // }
    public function register() {
        app()->singleton("myservice", "App\MyClasses\PowerMyService");
        app()->singleton("App\MyClasses\MyServiceInterface", "App\MyClasses\PowerMyService");
        echo "<b><MyServiceProvider/register></b><br>";
    }

    /**
     * Bootstrap services.
     * 起動処理の実行。登録したサービスの初期化処理などを行う。
     * @return void
     */
    public function boot() {
        //
        echo "<b><MyServiceProvider/boot></b><br>";
    }
}
