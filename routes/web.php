<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Home;

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
Route::get('/', Home::class)->name('home')->middleware('auth');
Route::get('login', App\Http\Livewire\Login::class)->name('login');
// All login
Route::group(['middleware' => ['auth']], function(){    
    Route::get('profile',App\Http\Livewire\Profile::class)->name('profile');
    Route::get('back-to-admin',[App\Http\Controllers\IndexController::class,'backtoadmin'])->name('back-to-admin');
    Route::get('setting',App\Http\Livewire\Setting::class)->name('setting');
    Route::get('users/insert',App\Http\Livewire\User\Insert::class)->name('users.insert');
    Route::get('user-access', App\Http\Livewire\UserAccess\Index::class)->name('user-access.index');
    Route::get('user-access/insert', App\Http\Livewire\UserAccess\Insert::class)->name('user-access.insert');
    Route::get('user-access/edit/{id}', App\Http\Livewire\UserAccess\Edit::class)->name('user-access.edit');
    Route::get('users',App\Http\Livewire\User\Index::class)->name('users.index');
    Route::get('users/edit/{id}',App\Http\Livewire\User\Edit::class)->name('users.edit');
    Route::post('users/autologin/{id}',[App\Http\Livewire\User\Index::class,'autologin'])->name('users.autologin');
    Route::get('module',App\Http\Livewire\Module\Index::class)->name('module.index');
    Route::get('module/insert',App\Http\Livewire\Module\Insert::class)->name('module.insert');
    Route::get('module/edit/{id}',App\Http\Livewire\Module\Edit::class)->name('module.edit');
    Route::get('customer',App\Http\Livewire\Customer\Index::class)->name('customer');
    Route::get('customer/insert',App\Http\Livewire\Customer\Insert::class)->name('customer.insert');
    Route::get('project',\App\Http\Livewire\Project\Index::class)->name('project');
    Route::get('project/insert',\App\Http\Livewire\Project\Insert::class)->name('project.insert');
    Route::get('vendor',App\Http\Livewire\Vendor\Index::class)->name('vendor');
    Route::get('vendor/insert',App\Http\Livewire\Vendor\Insert::class)->name('vendor.insert');
    Route::get('vendor/edit/{id}',App\Http\Livewire\Vendor\Edit::class)->name('vendor.edit');
    Route::get('budget/index',App\Http\Livewire\Budget\Index::class)->name('budget.index');
    Route::get('region/index',App\Http\Livewire\Region\Index::class)->name('region.index');
    Route::get('region/insert',App\Http\Livewire\Region\Insert::class)->name('region.insert');

    Route::get('cluster',App\Http\Livewire\Cluster\Index::class)->name('cluster.index');
    Route::get('cluster/edit/{id}',App\Http\Livewire\Cluster\Edit::class)->name('cluster.edit');
    Route::get('cluster/delete/{id}',App\Http\Livewire\Cluster\Delete::class)->name('cluster.delete');
    Route::get('cluster/insert',App\Http\Livewire\Cluster\Insert::class)->name('cluster.insert');

    Route::get('company',App\Http\Livewire\Company\Index::class)->name('company.index');
    Route::get('company/edit/{id}',App\Http\Livewire\Company\Edit::class)->name('company.edit');
    Route::get('company/delete/{id}',App\Http\Livewire\Company\Delete::class)->name('company.delete');
    Route::get('company/insert',App\Http\Livewire\Company\Insert::class)->name('company.insert');

    Route::get('site-tracking',App\Http\Livewire\Sitetracking\Index::class)->name('site-tracking.index');
    Route::get('site-tracking/dashboard',App\Http\Livewire\Sitetracking\Dashboard::class)->name('site-tracking.dashboard');
    Route::get('site-tracking/edit/{id}',App\Http\Livewire\Sitetracking\Edit::class)->name('site-tracking.edit');
    Route::post('site-tracking/deleteoriginal', [App\Http\Controllers\DuplicateSiteListController::class,'deleteoriginal'])->name('site-tracking.deleteoriginal');
    Route::post('site-tracking/deleteduplicate', [App\Http\Controllers\DuplicateSiteListController::class,'deleteduplicate'])->name('site-tracking.deleteduplicate');
    Route::post('site-tracking/cekdataTemp', [App\Http\Controllers\DuplicateSiteListController::class,'cekdataTemp'])->name('site-tracking.cekdataTemp');
    Route::post('site-tracking/cekdataOri', [App\Http\Controllers\DuplicateSiteListController::class,'cekdataOri'])->name('site-tracking.cekdataOri');
    Route::post('site-tracking/dashboardsitelist', [App\Http\Controllers\DuplicateSiteListController::class,'dashboardsitelist'])->name('site-tracking.dashboardsitelist');
    Route::post('site-tracking/approvesitelisttracking', [App\Http\Controllers\DuplicateSiteListController::class,'approvesitelisttracking'])->name('site-tracking.approvesitelisttracking');
    Route::get('site-tracking/insert',App\Http\Livewire\Sitetracking\Insert::class)->name('site-tracking.insert');
    
    Route::get('critical-case',App\Http\Livewire\Criticalcase\Index::class)->name('critical-case.index');
    Route::get('critical-case/data',App\Http\Livewire\Criticalcase\Data::class)->name('critical-case.data');
    Route::get('critical-case/dashboard',App\Http\Livewire\Criticalcase\Dashboard::class)->name('critical-case.dashboard');
    
    Route::get('po-tracking',App\Http\Livewire\POTracking\Index::class)->name('po-tracking.index');
    Route::get('po-tracking/data',App\Http\Livewire\POTracking\Data::class)->name('po-tracking.data');
    Route::get('po-tracking/insert',App\Http\Livewire\POTracking\Insert::class)->name('po-tracking.insert');
    Route::get('po-tracking/importesar',App\Http\Livewire\POTracking\Importesar::class)->name('po-tracking.importesar');
    Route::get('po-tracking/edit/{id}',App\Http\Livewire\POTracking\Edit::class)->name('po-tracking.edit');
    Route::get('po-tracking/edit-reimbursement/{id}',App\Http\Livewire\POTracking\Editreimbursement::class)->name('po-tracking.edit-reimbursement');
    Route::get('po-tracking/edit-esar/{id}',App\Http\Livewire\POTracking\Editesar::class)->name('po-tracking.edit-esar');
    Route::get('po-tracking/generate-esar/{po_tracking}',[App\Http\Controllers\POTrackingGenerateEsarController::class,'index'])->name('po-tracking.generate-esar');
    // Route::get('site-tracking/upload',App\Http\Livewire\Sitetracking\Upload::class)->name('site-tracking.upload');
    // Route::get('site-tracking/approval',App\Http\Livewire\Sitetracking\Approval::class)->name('site-tracking.approval');

    Route::get('employee',App\Http\Livewire\Employee\Index::class)->name('employee.index');
    Route::get('employee/insert',App\Http\Livewire\Employee\Insert::class)->name('employee.insert');
    Route::get('employee/edit/{id}',App\Http\Livewire\Employee\Edit::class)->name('employee.edit');
    Route::get('department',App\Http\Livewire\Department\Index::class)->name('department.index');
    Route::get('work-flow-management/dashboard',App\Http\Livewire\WorkFlowManagement\Index::class)->name('work-flow-management.index');
    Route::get('work-flow-management/data',App\Http\Livewire\WorkFlowManagement\Data::class)->name('work-flow-management.data');
    Route::get('customer-asset-management',App\Http\Livewire\CustomerAssetManagement\Index::class)->name('customer-asset-management.index');
    Route::get('customer-asset-management/data',App\Http\Livewire\CustomerAssetManagement\Data::class)->name('customer-asset-management.data');
    Route::get('sites',App\Http\Livewire\Sites\Index::class)->name('sites.index');
    Route::get('tower',App\Http\Livewire\Tower\Index::class)->name('tower.index');
});