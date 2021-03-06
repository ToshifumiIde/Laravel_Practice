<?php

use App\Http\Controllers\HelloController;
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

Route::get("/hello", [HelloController::class, "index"])->name("hello");
Route::get("/hello/{id}", [HelloController::class, "index"])->where("id", "[0-9]+");
// Route::post("/hello", [HelloController::class, "send"])->name("hello.post");
Route::get("hello/json", [HelloController::class, "json"]);
Route::get("hello/json/{id?}", [HelloController::class, "json"]);
Route::get("hello/clear", [HelloController::class, "clear"]);
