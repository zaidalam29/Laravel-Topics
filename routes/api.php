<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dummyAPI;
use App\Http\Controllers\DeviceAPI;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("data", [dummyAPI::class,'getData']);
Route::get("list/{id?}", [DeviceAPI::class,'list']);
Route::put("update", [DeviceAPI::class,'update']);
Route::post("add", [DeviceAPI::class,'add']);
Route::get("search/{name}", [DeviceAPI::class,'search']);
Route::delete("delete/{id}", [DeviceAPI::class,'delete']);
Route::post("save", [DeviceAPI::class,'save']);




