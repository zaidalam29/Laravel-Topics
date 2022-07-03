<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RazorpayPaymentController;

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

Route::view('about', 'about');
Route::view('home', 'home');

Route::view('noaccess', 'noaccess');

Route::group(['middleware'=>['protectedPage']], function(){
    Route::view('user', 'user');


});

Route::get('payment', [RazorpayPaymentController::class, 'index']);
Route::post('payments', [RazorpayPaymentController::class, 'store']);
