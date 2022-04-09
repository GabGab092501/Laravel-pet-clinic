<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\animalController;
use App\Http\Controllers\customerController;
use App\Http\Controllers\personnelController;
use App\Http\Controllers\diseaseInjuryController;
use App\Http\Controllers\serviceController;
use App\Http\Controllers\contactController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\consolationController;
use App\Http\Controllers\transactionController;

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
Route::get("/contact/restore/{id}", [
    "uses" => "contactController@restore",
    "as" => "contact.restore",
]);
Route::get("/contact/forceDelete/{id}", [
    "uses" => "contactController@forceDelete",
    "as" => "contact.forceDelete",
]);
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

Route::resource("/customer", "customerController")->middleware("auth");
//Route::resource("/customer", customerController::class);
Route::get("/customer/restore/{id}", [
    "uses" => "customerController@restore",
    "as" => "customer.restore",
]);
Route::get("/customer/forceDelete/{id}", [
    "uses" => "customerController@forceDelete",
    "as" => "customer.forceDelete",
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

Route::resource("/personnel", "personnelController")->middleware("auth");
//Route::resource("/personnel", personnelController::class);
Route::get("/personnel/restore/{id}", [
    "uses" => "personnelController@restore",
    "as" => "personnel.restore",
]);
Route::get("/personnel/forceDelete/{id}", [
    "uses" => "personnelController@forceDelete",
    "as" => "personnel.forceDelete",
]);

Route::resource("/service", serviceController::class)->middleware("auth");
Route::get("/service/restore/{id}", [
    "uses" => "serviceController@restore",
    "as" => "service.restore",
]);
Route::get("/service/forceDelete/{id}", [
    "uses" => "serviceController@forceDelete",
    "as" => "service.forceDelete",
]);

Route::resource("/consultation", consultationController::class)->middleware("auth");
Route::get("/consultation/restore/{id}", [
    "uses" => "consultationController@restore",
    "as" => "consultation.restore",
]);
Route::get("/consultation/forceDelete/{id}", [
    "uses" => "consultationController@forceDelete",
    "as" => "consultation.forceDelete",
]);
//Route::get('/search', 'App\Http\Controllers\consultationController@search')->name("search")->middleware("auth");
//Route::get("/search", [consultationController::class, "search"])->name("search");
Route::get('/result', 'App\Http\Controllers\consultationController@result')->name("result")->middleware("auth");
//Route::get("/result", [consultationController::class, "result"])->name("result");
Route::get('/result', 'App\Http\Controllers\customerController@result')->name("result")->middleware("auth");

Route::resource("/transaction", transactionController::class)->middleware("auth");


Route::get("/", function () {
    return view("welcome");
});

Route::get("signup", [
    "uses" => "personnelController@getSignup",
    "as" => "personnel.signup",
])->middleware("guest");

Route::post("signup", [
    "uses" => "personnelController@postSignup",
    "as" => "personnel.signup",
])->middleware("guest");

Route::get("dashboard", [
    "uses" => "personnelController@Dashboard",
    "as" => "personnels.dashboard",
])->middleware("auth");

Route::post("logout", [
    "uses" => "personnelController@getLogout",
    "as" => "personnel.logout",
]);

Route::get("logout", [
    "uses" => "personnelController@getLogout",
    "as" => "personnel.logout",
]);

Route::post("signin", [
    "uses" => "personnelController@postSignin",
    "as" => "personnel.signin",
])->middleware("guest");

Route::get("signin", [
    "uses" => "personnelController@getSignin",
    "as" => "personnel.signin",
])->middleware("guest");

Route::post("email", [
    "uses" => "personnelController@Email",
    "as" => "personnel.email",
]);

Route::get("email", [
    "uses" => "personnelController@Email",
    "as" => "personnel.email",
]);

Route::post("reset", [
    "uses" => "personnelController@Reset",
    "as" => "personnel.reset",
]);

Route::get("reset", [
    "uses" => "personnelController@Reset",
    "as" => "personnel.reset",
]);

Route::get('shopping-cart', [
    'uses' => 'App\Http\Controllers\transactionController@getCart',
    'as' => 'transaction.shoppingCart'
]);

Route::get('checkout', [
    'uses' => 'transactionController@postCheckout',
    'as' => 'checkout',
]);

Route::get('/receipt', 'App\Http\Controllers\transactionController@getReceipt')->name("receipt")->middleware("auth");

Route::get('add-to-cart/{id}', [
    'uses' => 'App\Http\Controllers\transactionController@getAddToCart',
    'as' => 'transaction.addToCart'
]);

Route::get('add-animal/{id}', [
    'uses' => 'App\Http\Controllers\transactionController@getAnimal',
    'as' => 'transaction.addAnimal'
]);

Route::get('remove/{id}', [
    'uses' => 'App\Http\Controllers\transactionController@getRemoveItem',
    'as' => 'transaction.remove'
]);
