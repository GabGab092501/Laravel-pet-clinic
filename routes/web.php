<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\petsController;
use App\Http\Controllers\customerController;
use App\Http\Controllers\hoomansController;
use App\Http\Controllers\serviceController;
use App\Http\Controllers\contactController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\consolationController;
use App\Http\Controllers\transactionController;
use App\Http\Controllers\classifyController;
use App\Http\Controllers\diseasesController;
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

Route::resource("/pets", "petsController")->middleware("auth");
Route::get("/pets/restore/{id}", [
    "uses" => "petsController@restore",
    "as" => "pets.restore",
]);
Route::get("/pets/forceDelete/{id}", [
    "uses" => "petsController@forceDelete",
    "as" => "pets.forceDelete",
]);

Route::resource("/customer", "customerController")->middleware("auth");
Route::get("/customer/restore/{id}", [
    "uses" => "customerController@restore",
    "as" => "customer.restore",
]);
Route::get("/customer/forceDelete/{id}", [
    "uses" => "customerController@forceDelete",
    "as" => "customer.forceDelete",
]);

Route::resource("/hoomans", "hoomansController")->middleware("auth");
Route::get("/hoomans/restore/{id}", [
    "uses" => "hoomansController@restore",
    "as" => "hoomans.restore",
]);
Route::get("/hoomans/forceDelete/{id}", [
    "uses" => "hoomansController@forceDelete",
    "as" => "hoomans.forceDelete",
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
Route::get('/results', 'App\Http\Controllers\consultationController@results')->name("results")->middleware("auth");
Route::get('/result', 'App\Http\Controllers\customerController@result')->name("result")->middleware("auth");

Route::resource("/transaction", transactionController::class)->middleware("auth");

Route::get("/", function () {
    return view("welcome");
});
Route::get('/homewelcome', function () {
    return view('homewelcome');
});

Route::get('/home', function () {
    return view('home');
});

Route::get("signup", [
    "uses" => "hoomansController@getSignup",
    "as" => "hoomans.signup",
])->middleware("guest");

Route::post("signup", [
    "uses" => "hoomansController@postSignup",
    "as" => "hoomans.signup",
])->middleware("guest");

Route::get("dashboard", [
    "uses" => "hoomansController@Dashboard",
    "as" => "hoomans.dashboard",
])->middleware("auth");

Route::post("logout", [
    "uses" => "hoomansController@getLogout",
    "as" => "hoomans.logout",
]);

Route::get("logout", [
    "uses" => "hoomansController@getLogout",
    "as" => "hoomans.logout",
]);

Route::post("signin", [
    "uses" => "hoomansController@postSignin",
    "as" => "hoomans.signin",
])->middleware("guest");

Route::get("signin", [
    "uses" => "hoomansController@getSignin",
    "as" => "hoomans.signin",
])->middleware("guest");

Route::get('shopping-cart', [
    'uses' => 'App\Http\Controllers\transactionController@getCart',
    'as' => 'transaction.shoppingCart',
    'middleware' => 'auth'
]);

Route::get('checkout', [
    'uses' => 'transactionController@postCheckout',
    'as' => 'checkout',
]);

Route::get('/receipt', 'App\Http\Controllers\transactionController@getReceipt')->name("receipt")->middleware("auth");


Route::get('data', [
    'uses' => 'App\Http\Controllers\transactionController@getData',
    'as' => 'data',
    'middleware' => 'auth'
]);


Route::get('add-to-cart/{id}', [
    'uses' => 'App\Http\Controllers\transactionController@getAddToCart',
    'as' => 'transaction.addToCart'
]);

Route::get('add-animal/{id}', [
    'uses' => 'App\Http\Controllers\transactionController@getAnimal',
    'as' => 'transaction.addAnimal'
]);

Route::resource("/classify", "classifyController")->middleware("auth");
Route::get("/classify/restore/{id}", [
    "uses" => "classifyController@restore",
    "as" => "classify.restore",
]);

Route::resource("/diseases", "diseasesController")->middleware("auth");
Route::get("/diseases/restore/{id}", [
    "uses" => "diseasesController@restore",
    "as" => "diseases.restore",
]);

Route::get('remove/{id}', [
    'uses' => 'App\Http\Controllers\transactionController@getRemoveItem',
    'as' => 'transaction.remove'
]);
