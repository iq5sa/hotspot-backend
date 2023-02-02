<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Http;
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

Route::redirect("/","/admin");
Route::get("/client/login",[ClientController::class,"loginIndex"]);
Route::post("/client/login/submit",[ClientController::class,"loginSubmit"])->name("client.login.submit");



Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
