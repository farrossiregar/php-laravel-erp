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

Route::group(['middleware' => 'cors', 'json.response'], function(){
	Route::post('auth-login', [\App\Http\Controllers\Api\UserController::class,'login']);
	Route::post('register', [\App\Http\Controllers\Api\UserController::class,'register']);
	Route::get('all-user', [\App\Http\Controllers\Api\UserController::class,'allUser']);
});

Route::group(['middleware' => ['auth:api','cors', 'json.response']], function(){
	Route::get('get-customer-asset-management',[\App\Http\Controllers\Api\CustomerAssetManagementController::class,'index']);
	Route::get('details', 'Api\UserController@details');
	Route::get('get-sites',[\App\Http\Controllers\Api\SitesController::class,'getAll']);
});