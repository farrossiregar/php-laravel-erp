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
});

Route::group(['middleware' => 'auth:api'], function(){
	Route::get('get-customer-asset-management',[\App\Http\Controllers\Api\CustomerAssetManagementController::class,'index']);
	Route::post('customer-asset-management/submit',[\App\Http\Controllers\Api\CustomerAssetManagementController::class,'submit'])->name('api.customer-asset.submit-checking');
	Route::post('commitment-daily/store',[\App\Http\Controllers\Api\CommitmentDailyController::class,'store'])->name('api.commitment-daily.store');
	Route::get('commitment-daily/check',[\App\Http\Controllers\Api\CommitmentDailyController::class,'check'])->name('api.commitment-daily.check');
	Route::get('commitment-daily/data',[\App\Http\Controllers\Api\CommitmentDailyController::class,'data'])->name('api.commitment-daily.data');
	Route::get('location-of-field-team/set-active',[\App\Http\Controllers\Api\LocationOfFieldTeamController::class,'setActive'])->name('api.location-of-field-team.set-active');
	Route::get('location-of-field-team/set-inactive',[\App\Http\Controllers\Api\LocationOfFieldTeamController::class,'setInactive'])->name('api.location-of-field-team.set-inactive');
	Route::post('location-of-field-team/store',[\App\Http\Controllers\Api\LocationOfFieldTeamController::class,'store'])->name('api.location-of-field-team.store');
	Route::get('location-of-field-team/check',[\App\Http\Controllers\Api\LocationOfFieldTeamController::class,'check'])->name('api.location-of-field-team.check');
	Route::get('location-of-field-team/check-active',[\App\Http\Controllers\Api\LocationOfFieldTeamController::class,'checkActive'])->name('api.location-of-field-team.check-active');
	Route::get('location-of-field-team/data',[\App\Http\Controllers\Api\LocationOfFieldTeamController::class,'data'])->name('api.location-of-field-team.data');
	Route::get('location-of-field-team/get-nearest',[\App\Http\Controllers\Api\LocationOfFieldTeamController::class,'getNearest'])->name('api.location-of-field-team.get-nearest');
	Route::get('get-sites',[\App\Http\Controllers\Api\SitesController::class,'getAll']);
	Route::post('speed-warning/store',[\App\Http\Controllers\Api\SpeedWarningController::class,'store'])->name('api.speed-warning.store');
});