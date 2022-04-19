<?php

use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\{
    UserController,
    AdminController
};

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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get("/admin", [AdminController::class, "index"]);
Route::get("/", [UserController::class, "index"]);
Route::get("/redirect-url", [UserController::class, "redirect"]);
Route::post("/create-payment", [UserController::class, "createPayment"]);
Route::get("/confirm-payment/{id}", [UserController::class, "confirmPayment"]);
Route::get("/get-payment/{id}", [UserController::class, "getPayment"]);
Route::get("/get-all-payments", [UserController::class, "getAllPayments"]);
Route::get("/history", [UserController::class, "history"]);
