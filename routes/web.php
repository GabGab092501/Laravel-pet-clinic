<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\animalController;
use App\Http\Controllers\rescuerController;
use App\Http\Controllers\personnelController;
use App\Http\Controllers\diseaseInjuryController;
use App\Http\Controllers\adopterController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|  Prettier for php: composer fix-cs
*/

Route::resource("/animals", "animalController")->middleware("isLoggedIn");
Route::get("/animals/restore/{id}", [
    "uses" => "animalController@restore",
    "as" => "animals.restore",
]);
Route::get("/animals/forceDelete/{id}", [
    "uses" => "animalController@forceDelete",
    "as" => "animals.forceDelete",
]);

Route::get("/search", [animalController::class, "search"])->name("search");
Route::get("/result", [animalController::class, "result"])->name("result");

Route::resource("/rescuer", "rescuerController")->middleware("isLoggedIn");
//Route::resource("/rescuer", rescuerController::class)->middleware("isLoggedIn");
Route::get("/rescuer/restore/{id}", [
    "uses" => "rescuerController@restore",
    "as" => "rescuer.restore",
]);
Route::get("/rescuer/forceDelete/{id}", [
    "uses" => "rescuerController@forceDelete",
    "as" => "rescuer.forceDelete",
]);

Route::resource("/diseaseinjury", diseaseInjuryController::class)->middleware(
    "isLoggedIn"
);
Route::get("/diseaseinjury/restore/{id}", [
    "uses" => "diseaseInjuryController@restore",
    "as" => "diseaseinjury.restore",
]);
Route::get("/diseaseinjury/forceDelete/{id}", [
    "uses" => "diseaseInjuryController@forceDelete",
    "as" => "diseaseinjury.forceDelete",
]);

Route::resource("/personnel", personnelController::class)->middleware(
    "isLoggedIn"
);
Route::get("/personnel/restore/{id}", [
    "uses" => "personnelController@restore",
    "as" => "personnel.restore",
]);
Route::get("/personnel/forceDelete/{id}", [
    "uses" => "personnelController@forceDelete",
    "as" => "personnel.forceDelete",
]);

Route::resource("/adopter", adopterController::class)->middleware("isLoggedIn");
Route::get("/adopter/restore/{id}", [
    "uses" => "adopterController@restore",
    "as" => "adopter.restore",
]);
Route::get("/adopter/forceDelete/{id}", [
    "uses" => "adopterController@forceDelete",
    "as" => "adopter.forceDelete",
]);

Route::get("/login", [personnelController::class, "login"])->middleware(
    "alreadyLoggedIn"
);
Route::post("/check", [personnelController::class, "check"])->name("check");
Route::get("/dashboard", [personnelController::class, "dashboard"])->middleware(
    "isLoggedIn"
);
Route::get("/logout", [personnelController::class, "logout"])->middleware(
    "isLoggedIn"
);
Route::get("/personnel/create", [personnelController::class,"create",])->middleware("alreadyLoggedIn");
