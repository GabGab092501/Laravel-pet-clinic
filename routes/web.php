<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\animalController;
use App\Http\Controllers\rescuerController;
use App\Http\Controllers\personnelController;
use App\Http\Controllers\diseaseInjuryController;
use App\Http\Controllers\adopterController;
use App\Http\Controllers\contactController;
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
Route::resource("/contact", "contactController")->middleware("auth");
Route::get("/review", [contactController::class, "review"])->name("review");
Route::post("/send", [contactController::class, "send"])->name("send");

Route::resource("/animals", "animalController")->middleware("auth");
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

Route::resource("/rescuer", "rescuerController")->middleware("auth");
//Route::resource("/rescuer", rescuerController::class)->middleware("auth");
Route::get("/rescuer/restore/{id}", [
    "uses" => "rescuerController@restore",
    "as" => "rescuer.restore",
]);
Route::get("/rescuer/forceDelete/{id}", [
    "uses" => "rescuerController@forceDelete",
    "as" => "rescuer.forceDelete",
]);

Route::resource("/diseaseinjury", diseaseInjuryController::class)->middleware(
    "auth"
);
Route::get("/diseaseinjury/restore/{id}", [
    "uses" => "diseaseInjuryController@restore",
    "as" => "diseaseinjury.restore",
]);
Route::get("/diseaseinjury/forceDelete/{id}", [
    "uses" => "diseaseInjuryController@forceDelete",
    "as" => "diseaseinjury.forceDelete",
]);

Route::resource("/personnel", personnelController::class)->middleware("auth");
Route::get("/personnel/restore/{id}", [
    "uses" => "personnelController@restore",
    "as" => "personnel.restore",
]);
Route::get("/personnel/forceDelete/{id}", [
    "uses" => "personnelController@forceDelete",
    "as" => "personnel.forceDelete",
]);

Route::resource("/adopter", adopterController::class)->middleware("auth");
Route::get("/adopter/restore/{id}", [
    "uses" => "adopterController@restore",
    "as" => "adopter.restore",
]);
Route::get("/adopter/forceDelete/{id}", [
    "uses" => "adopterController@forceDelete",
    "as" => "adopter.forceDelete",
]);

//Route::get('/login', [App\Http\Controllers\personnelController::class, "login"])->name('login');//->middleware("auth");
//Route::post("/check", [personnelController::class, "check"])->name("check");
//Route::get("/dashboard", [personnelController::class, "dashboard"]);//->middleware("auth");
//Route::get("/logout", [personnelController::class, "logout"]);//->middleware("auth");

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
 })->middleware(['auth'])->name('dashboard');

//require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

