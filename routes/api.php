<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

date_default_timezone_set("Asia/Bangkok");

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
	Route::post('location-of-field-team/get-nearest',[\App\Http\Controllers\Api\LocationOfFieldTeamController::class,'getNearest'])->name('api.location-of-field-team.get-nearest');
	Route::get('get-sites',[\App\Http\Controllers\Api\SitesController::class,'getAll']);
	Route::post('speed-warning/store',[\App\Http\Controllers\Api\SpeedWarningController::class,'store'])->name('api.speed-warning.store');
	Route::get('speed-warning/data',[\App\Http\Controllers\Api\SpeedWarningController::class,'data'])->name('api.speed-warning.data');
	Route::post('ppe-check/store',[\App\Http\Controllers\Api\PpeCheckController::class,'store'])->name('api.ppe-check.store');
	Route::post('ppe-check/upload',[\App\Http\Controllers\Api\PpeCheckController::class,'upload'])->name('api.ppe-check.upload');
	Route::get('ppe-check/get-detail',[\App\Http\Controllers\Api\PpeCheckController::class,'getDetail'])->name('api.ppe-check.get-detail');
	Route::get('ppe-check/history',[\App\Http\Controllers\Api\PpeCheckController::class,'history'])->name('api.ppe-check.history');
	Route::post('tools-check/store',[\App\Http\Controllers\Api\ToolsCheckController::class,'store'])->name('api.tools-check.store');
	Route::post('tools-check/data',[\App\Http\Controllers\Api\ToolsCheckController::class,'data'])->name('api.tools-check.data');
	Route::post('tools-check/store-image',[\App\Http\Controllers\Api\ToolsCheckController::class,'storeImage'])->name('api.tools-check.store-image');
	Route::post('tools-check/delete-image',[\App\Http\Controllers\Api\ToolsCheckController::class,'deleteImage'])->name('api.tools-check.delete-image');
	Route::post('tools-check/store-stolen',[\App\Http\Controllers\Api\ToolsCheckController::class,'storeStolen'])->name('api.tools-check.store-stolen');
	Route::post('tools-check/store-broken',[\App\Http\Controllers\Api\ToolsCheckController::class,'storeBroken'])->name('api.tools-check.store-broken');
	Route::get('tools-check/get-toolbox',[\App\Http\Controllers\Api\ToolsCheckController::class,'get_toolbox'])->name('api.tools-check.get-toolbox');
	Route::get('tools-check/get-toolbox-check/{id}',[\App\Http\Controllers\Api\ToolsCheckController::class,'get_toolbox_check'])->name('api.tools-check.get-toolbox-check');
	Route::get('tools-check/get-image/{id}',[\App\Http\Controllers\Api\ToolsCheckController::class,'getImage'])->name('api.tools-check.get-image');
	Route::post('tools-check/get-image-by-parent',[\App\Http\Controllers\Api\ToolsCheckController::class,'getImageByParent'])->name('api.tools-check.get-image-by-parent');
	Route::get('tools-check/history',[\App\Http\Controllers\Api\ToolsCheckController::class,'history'])->name('api.tools-check.history');
	Route::post('vehicle-check/store',[\App\Http\Controllers\Api\VehicleCheckController::class,'store'])->name('api.vehicle-check.store');
	Route::post('vehicle-check/upload-vehicle-cleanliness',[\App\Http\Controllers\Api\VehicleCheckController::class,'uploadVehicleCleanliness'])->name('api.vehicle-check.upload-vehicle-cleanliness');
	Route::post('vehicle-check/upload-vehicle-accident-report',[\App\Http\Controllers\Api\VehicleCheckController::class,'uploadVehicleAccidentReport'])->name('api.vehicle-check.upload-vehicle-accident-report');
	Route::post('vehicle-check/upload-vehicle',[\App\Http\Controllers\Api\VehicleCheckController::class,'uploadVehicle'])->name('api.vehicle-check.upload-vehicle');
	Route::post('vehicle-check/upload-sticker',[\App\Http\Controllers\Api\VehicleCheckController::class,'uploadSticker'])->name('api.vehicle-check.upload-sticker');
	Route::post('vehicle-check/delete-image',[\App\Http\Controllers\Api\VehicleCheckController::class,'deleteImage'])->name('api.vehicle-check.delete-image');
	Route::get('vehicle-check/history',[\App\Http\Controllers\Api\VehicleCheckController::class,'history'])->name('api.vehicle-check.history');
	Route::get('vehicle-check/get-last',[\App\Http\Controllers\Api\VehicleCheckController::class,'getLast'])->name('api.vehicle-check.get-last');
	Route::get('vehicle-check/get-vehicle-cleanlines',[\App\Http\Controllers\Api\VehicleCheckController::class,'getVehicleCleanliness'])->name('api.get-vehicle-cleanliness');
	Route::get('vehicle-check/get-vehicle-accident-report',[\App\Http\Controllers\Api\VehicleCheckController::class,'getVehicleAccidentReport'])->name('api.get-vehicle-accident-report');
	Route::get('vehicle-check/get-vehicle-cleanlines-by-id/{id}',[\App\Http\Controllers\Api\VehicleCheckController::class,'getVehicleCleanlinessById'])->name('api.get-vehicle-cleanliness-by-id');
	Route::get('vehicle-check/get-vehicle-accident-report-by-id/{id}',[\App\Http\Controllers\Api\VehicleCheckController::class,'getVehicleAccidentReportById'])->name('api.get-vehicle-accident-report-by-id');
	Route::get('menu',[\App\Http\Controllers\Api\HomeController::class,'menu'])->name('menu');
	Route::get('site-by-field-team',[\App\Http\Controllers\Api\SitesController::class,'getByFieldTeam'])->name('api.sites-by-field-team');
	Route::post('health-check/store',[\App\Http\Controllers\Api\HealthCheckController::class,'store'])->name('api.health-check.store');
	Route::get('health-check/get-today',[\App\Http\Controllers\Api\HealthCheckController::class,'getToday'])->name('api.health-check.get-today');
	Route::post('user/update',[\App\Http\Controllers\Api\UserController::class,'update'])->name('api.user.update');
	Route::get('work-order',[\App\Http\Controllers\Api\WorkOrderController::class,'data'])->name('api.work-order.data');
	Route::get('work-order/notification',[\App\Http\Controllers\Api\WorkOrderController::class,'notification'])->name('api.work-order.notification');
	Route::post('work-order/upload-bast-image',[\App\Http\Controllers\Api\WorkOrderController::class,'uploadBastImage'])->name('api.work-order.upload-bast-image');
	Route::get('work-order/get-bast/{id}',[\App\Http\Controllers\Api\WorkOrderController::class,'getBast'])->name('api.work-order.get-bast');
	Route::post('work-order/submit-bast',[\App\Http\Controllers\Api\WorkOrderController::class,'submitBast'])->name('api.work-order.submit-bast');
	Route::get('work-order/open',[\App\Http\Controllers\Api\WorkOrderController::class,'workOrderOpen'])->name('api.work-order.open');
	Route::get('work-order/closed',[\App\Http\Controllers\Api\WorkOrderController::class,'workOrderClosed'])->name('api.work-order.closed');
	Route::get('work-order/accepted',[\App\Http\Controllers\Api\WorkOrderController::class,'workOrderAccepted'])->name('api.work-order.accepted');
	Route::get('work-order/general',[\App\Http\Controllers\Api\WorkOrderController::class,'workOrderGeneral'])->name('api.work-order.general');
	
	Route::get('drug-test/history',[\App\Http\Controllers\Api\DrugTestController::class,'history'])->name('api.drug-test.history');
	Route::post('drug-test/upload-image',[\App\Http\Controllers\Api\DrugTestController::class,'uploadImage'])->name('api.drug-test.upload-image');
	Route::get('drug-test/get-image/{id}',[\App\Http\Controllers\Api\DrugTestController::class,'getImage'])->name('api.drug-test.get-image');
	Route::get('preventive-maintenance/history',[\App\Http\Controllers\Api\PreventiveMaintenanceController::class,'history'])->name('api.preventive-maintenance.history');
	Route::get('preventive-maintenance/get-image/{id}',[\App\Http\Controllers\Api\PreventiveMaintenanceController::class,'getImage'])->name('api.preventive-maintenance.get-image');
	Route::post('preventive-maintenance/upload-image',[\App\Http\Controllers\Api\PreventiveMaintenanceController::class,'uploadImage'])->name('api.preventive-maintenance.upload-image');
	Route::post('preventive-maintenance/submit',[\App\Http\Controllers\Api\PreventiveMaintenanceController::class,'submit'])->name('api.preventive-maintenance.submit');
	Route::post('training-material/history',[\App\Http\Controllers\Api\TrainingMaterialController::class,'history'])->name('api.training-material.history');
	Route::post('training-material/upload-image',[\App\Http\Controllers\Api\TrainingMaterialController::class,'uploadImage'])->name('api.training-material.upload-image');
	Route::get('training-material/get-image/{id}',[\App\Http\Controllers\Api\TrainingMaterialController::class,'getImage'])->name('api.training-material.get-image');
	Route::get('training-material/get-file/{id}',[\App\Http\Controllers\Api\TrainingMaterialController::class,'getFile'])->name('api.training-material.get-file');
	Route::get('training-material/get-exam/{id}',[\App\Http\Controllers\Api\TrainingMaterialController::class,'getExam'])->name('api.training-material.get-exam');
	Route::post('training-material/store-jawaban',[\App\Http\Controllers\Api\TrainingMaterialController::class,'storeJawaban'])->name('api.training-material.store-jawaban');
	Route::post('training-material/submit-jawaban',[\App\Http\Controllers\Api\TrainingMaterialController::class,'submitJawaban'])->name('api.training-material.submit-jawaban');
	Route::post('user/upload-photo',[\App\Http\Controllers\Api\UserController::class,'uploadPhoto'])->name('api.user.upload-photo');
	Route::post('user/change-password',[\App\Http\Controllers\Api\UserController::class,'changePassword'])->name('api.user.change-password');
	Route::get('user/check-token',[\App\Http\Controllers\Api\UserController::class,'checkToken']);
}); 