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
Route::get("/hello/{id?}" , [HelloController::class , "index"])->name("hello");
Route::post("/hello" , [HelloController::class , "index"]);

