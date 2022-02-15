<?php

use App\Http\Controllers\Sample\SampleController;
use App\Http\Controllers\HelloController;
use App\Http\Middleware\HelloMiddleware;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// 2-1 サービスコンテナと結合
// Route::get("/hello", [HelloController::class, "index"])->name("hello");
// Route::get("/hello/{id?}" , [HelloController::class , "index"])->name("hello");
// Route::post("/hello" , [HelloController::class , "index"]);


// 2-3 ミドルウェア（Route毎のmiddlewareの設定）
// Route::get("/hello", [HelloController::class, "index"])->middleware(App\Http\Middleware\MyMiddleware::class)->name("hello");
// Route::get("/hello/{id?}", [HelloController::class, "index"])->middleware(App\Http\Middleware\MyMiddleware::class);

// 2-3ミドルウェア（app/Http/Kernel.phpのグローバルミドルウェアにMyMiddlewareを登録した後のRouteの設定）
// Route::get("/hello", [HelloController::class, "index"]);
// Route::get("/hello/{id?}", [HelloController::class, "index"]);

// 2-3ミドルウェア(app/Http/Kernel.phpの$middlewareGroupsで設定した"MyMW"を呼び出す場合)
Route::get("/hello" , [HelloController::class, "index"])->middleware("MyMW");
