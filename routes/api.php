<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('auth-login', [\App\Http\Controllers\Api\UserController::class,'login']);
Route::post('register', [\App\Http\Controllers\Api\UserController::class,'register']);
Route::get('all-user', [\App\Http\Controllers\Api\UserController::class,'allUser']);
Route::get('get-customer-asset-management',[\App\Http\Controllers\Api\CustomerAssetManagementController::class,'data']);

Route::group(['middleware' => 'auth:api'], function(){
	Route::get('details', 'Api\UserController@details');
});

Route::post('login',function(){
    
});