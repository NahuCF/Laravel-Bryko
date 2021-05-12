<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobsController;

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

Route::get("/", [HomeController::class, "index"])
    ->name("index");

Route::post("/register", [HomeController::class, "register"])
    ->name("register");

Route::post("/login", [HomeController::class, "login"])
    ->name("login");

Route::get("/logout", [HomeController::class, "logout"])
    ->name("logout");

Route::post("/apply", [HomeController::class, "apply"])
    ->name("apply");

Route::post("/dowload", [HomeController::class, "dowload"])
    ->name("dowload");


Route::resource("/job", JobsController::class)->only(["create", "store", "index"]);