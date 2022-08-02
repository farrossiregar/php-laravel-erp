<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Home;

date_default_timezone_set("Asia/Bangkok");

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
Route::post('diskalert',function(){
    //send_wa(['phone'=>'081289992707','message'=>'Warning, Disk server alibaba penuh, silahkan cek']);
    send_wa(['phone'=>'087775365856','message'=>"Warning, Disk server alibaba penuh, silahkan cek"]);
});

Route::get('readerpdf',function(){
    // Parse PDF file and build necessary objects.
    $parser = new \Smalot\PdfParser\Parser();
    // $pdf = $parser->parseFile('/var/www/erp-pmt/public/sample-pdf.pdf');
    $pdf = $parser->parseFile('/var/www/erp-pmt/public/sample-pdf.pdf');

    $text = $pdf->getText();
    echo $text;

    // $data = $pdf->getPages()[0]->getDataTm();
    // $data = $pdf->getPages();
    // dd($data);
});

// All login
Route::group(['middleware' => ['auth']], function(){    
    Route::get('get-employees',function(){

        $results = \App\Models\Employee::orderBy('name','ASC');

        if(isset($_GET['search'])) $results->where('name','LIKE',"%{$_GET['search']}%")->orWhere('nik','LIKE',"%{$_GET['search']}%");

        $data = [];
        // $data['total_count'] = 10;
        // $data['items'] = [];
        foreach($results->paginate(10) as $k => $item){
            $data[$k]['id'] = $item->id;
            $data[$k]['name'] = $item->nik .' / '.$item->name;
        }

        return response()->json($data);
    })->name('ajax.get-employees');

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
    Route::get('po-tracking/edit-bast/{id}',App\Http\Livewire\POTracking\Editbast::class)->name('po-tracking.edit-bast');
    Route::get('po-tracking/edit-accdoc/{id}',App\Http\Livewire\POTracking\Editaccdoc::class)->name('po-tracking.edit-accdoc');
    Route::get('po-tracking/generate-esar/{po_tracking}',[App\Http\Controllers\POTrackingGenerateEsarController::class,'index'])->name('po-tracking.generate-esar');
    
    /**
     * PO Tracking Nonms
     */
    Route::get('po-tracking-nonms',App\Http\Livewire\PoTrackingNonms\Index::class)->name('po-tracking-nonms.index');
    Route::get('po-tracking-nonms/indexboq',App\Http\Livewire\PoTrackingNonms\Indexboq::class)->name('po-tracking-nonms.indexboq');
    Route::get('po-tracking-nonms/indexstp',App\Http\Livewire\PoTrackingNonms\Indexstp::class)->name('po-tracking-nonms.indexstp');
    Route::get('po-tracking-nonms/importboq',App\Http\Livewire\PoTrackingNonms\Importboq::class)->name('po-tracking-nonms.importboq');
    Route::get('po-tracking-nonms/importstp',App\Http\Livewire\PoTrackingNonms\Importstp::class)->name('po-tracking-nonms.importstp');
    Route::get('po-tracking-nonms/edit-stp/{id}',App\Http\Livewire\PoTrackingNonms\Editstp::class)->name('po-tracking-nonms.edit-stp');
    Route::get('po-tracking-nonms/edit-boq/{id}',App\Http\Livewire\PoTrackingNonms\Editboq::class)->name('po-tracking-nonms.edit-boq');
    Route::get('po-tracking-nonms/po-detail/{id}',App\Http\Livewire\PoTrackingNonms\PoDetail::class)->name('po-tracking-nonms.po-detail');
    Route::get('po-tracking-nonms/po-create-bastl/{id}',App\Http\Livewire\PoTrackingNonms\PoCreateBast::class)->name('po-tracking-nonms.po-create-bast');
    Route::get('po-tracking-nonms/edit-bast/{id}',App\Http\Livewire\PoTrackingNonms\Editbast::class)->name('po-tracking-nonms.edit-bast');
    Route::get('po-tracking-nonms/generate-bast/{data}',[App\Http\Controllers\PoTrackingNonmsController::class,'generateBast'])->name('po-tracking-nonms.generate-bast');
    Route::get('po-tracking-nonms/generate-esar/{data}',[App\Http\Controllers\PoTrackingNonmsController::class,'generateEsar'])->name('po-tracking-nonms.generate-esar');
    Route::get('po-tracking-nonms/detailfoto/{id}',App\Http\Livewire\PoTrackingNonms\Detailfoto::class)->name('po-tracking-nonms.detailfoto');
    Route::get('po-tracking-nonms/approvedetailfoto',App\Http\Livewire\PoTrackingNonms\Approvedetailfoto::class)->name('po-tracking-nonms.approvedetailfoto');
    Route::get('po-tracking-nonms/po-generate-bast/{data}',[App\Http\Controllers\PoTrackingNonmsController::class,'po_generate_bast'])->name('po-tracking-nonms.po-generate-bast');
    
    Route::get('po-tracking-ms',App\Http\Livewire\PoTrackingMs\Index::class)->name('po-tracking-ms.index');
    Route::get('po-tracking-ms/preview/{id}',App\Http\Livewire\PoTrackingMs\Preview::class)->name('po-tracking-ms.preview');
    Route::get('dana-stpl',App\Http\Livewire\DanaStpl\Index::class)->name('dana-stpl.index');
    Route::get('dana-stpl/download-report',[App\Http\Controllers\DanaStplReportController::class,'downloadreport'])->name('dana-stpl.download-report');    
    Route::get('dana-stpl/insert',App\Http\Livewire\DanaStpl\Inputdanastpl::class)->name('dana-stpl.insert');
    Route::get('accident-report',App\Http\Livewire\AccidentReport\Index::class)->name('accident-report.index');
    Route::get('accident-report/insert',App\Http\Livewire\AccidentReport\Inputaccident::class)->name('accident-report.insert');
    Route::get('database-noc',App\Http\Livewire\DatabaseNoc\Index::class)->name('database-noc.index');
    Route::get('database-tools-noc',App\Http\Livewire\DatabaseToolsNoc\Index::class)->name('database-tools-noc.index');
    Route::get('petty-cash',App\Http\Livewire\PettyCash\Index::class)->name('petty-cash.index');
    Route::get('team-schedule',App\Http\Livewire\TeamSchedule\Index::class)->name('team-schedule.index');
    Route::get('timesheet-record',App\Http\Livewire\TimesheetRecord\Index::class)->name('timesheet-record.index');
    Route::get('hotel-flight-ticket',App\Http\Livewire\HotelFlightTicket\Index::class)->name('hotel-flight-ticket.index');
    
    /**
     * Finance & Accounting
     */
    Route::get('account-payable',App\Http\Livewire\AccountPayable\Index::class)->name('account-payable.index');
    Route::get('sales-account-receivable',App\Http\Livewire\SalesAccountReceivable\Index::class)->name('sales-account-receivable.index');
    Route::get('weekly-opex',App\Http\Livewire\Finance\WeeklyOpex::class)->name('weekly-opex.index');
    Route::get('other-opex',App\Http\Livewire\Finance\OtherOpex\OtherOpex::class)->name('other-opex.index');
    Route::get('rectification',App\Http\Livewire\Finance\Rectification\Rectification::class)->name('rectification.index');
    Route::get('subcont',App\Http\Livewire\Finance\Subcont\Subcont::class)->name('subcont.index');
    
    Route::get('site-keeper',function(){})->name('site-keeper.index');
    Route::get('hq-administration',function(){})->name('hq-administration.index');
    Route::get('payroll',function(){})->name('payroll.index');
    // Route::get('subcont',function(){})->name('subcont.index');
    Route::get('supplier-vendor',function(){})->name('supplier-vendor.index');
    Route::get('finance-petty-cash',App\Http\Livewire\Finance\PettyCash::class)->name('finance-petty-cash.index');
    // Route::get('other-opex',App\Http\Livewire\Finance\OtherOpex::class)->name('other-opex.index');
    
    Route::get('asset-database',App\Http\Livewire\AssetDatabase\Index::class)->name('asset-database.index');
    Route::get('asset-request',App\Http\Livewire\AssetRequest\Index::class)->name('asset-request.index');
    Route::get('request-detail-option',App\Http\Livewire\RequestDetailOption\Index::class)->name('request-detail-option.index');
    Route::get('asset-transfer-request',App\Http\Livewire\AssetTransferRequest\Index::class)->name('asset-transfer-request.index');
    Route::get('claiming-process',App\Http\Livewire\ClaimingProcess\Index::class)->name('claiming-process.index');
    Route::get('hrga-petty-cash',App\Http\Livewire\HrgaPettyCash\Index::class)->name('hrga-petty-cash.index');
    Route::get('consumable-item-request',App\Http\Livewire\ConsumableItemRequest\Index::class)->name('consumable-item-request.index');
    Route::get('consumable-item-database',App\Http\Livewire\ConsumableItemDatabase\Index::class)->name('consumable-item-database.index');
    Route::get('ticketing-system-complain',App\Http\Livewire\TicketingSystemComplain\Index::class)->name('ticketing-system-complain.index');
    Route::get('tracking-monitoring',App\Http\Livewire\TrackingMonitoring\Index::class)->name('tracking-monitoring.index');
    Route::get('employee',App\Http\Livewire\Employee\Index::class)->name('employee.index');
    Route::get('employee/insert',App\Http\Livewire\Employee\Insert::class)->name('employee.insert');
    Route::get('employee/edit/{id}',App\Http\Livewire\Employee\Edit::class)->name('employee.edit');
    Route::get('department',App\Http\Livewire\Department\Index::class)->name('department.index');
    Route::get('work-flow-management/dashboard',App\Http\Livewire\WorkFlowManagement\Index::class)->name('work-flow-management.index');
    Route::get('work-flow-management/data',App\Http\Livewire\WorkFlowManagement\Data::class)->name('work-flow-management.data');
    Route::get('customer-asset-management',App\Http\Livewire\CustomerAssetManagement\Index::class)->name('customer-asset-management.index');
    Route::get('customer-asset-management/history/{data}',App\Http\Livewire\CustomerAssetManagement\History::class)->name('customer-asset-management.history');
    Route::get('customer-asset-management/data',App\Http\Livewire\CustomerAssetManagement\Data::class)->name('customer-asset-management.data');
    Route::get('sites',App\Http\Livewire\Sites\Index::class)->name('sites.index');
    Route::get('sites/edit/{id}',App\Http\Livewire\Sites\Edit::class)->name('sites.edit');
    Route::get('tower',App\Http\Livewire\Tower\Index::class)->name('tower.index');
    Route::get('po-tracking-rollout',App\Http\Livewire\PoTrackingRollout\Index::class)->name('po-tracking-rollout.index');
    Route::get('mobile-apps',App\Http\Livewire\MobileApps\Index::class)->name('mobile-apps.index');
    Route::get('mobile-apps/insert-exam/{id}',App\Http\Livewire\MobileApps\TrainingMaterialInsertExam::class)->name('mobile-apps.insert-exam');
    Route::get('pm-report-tmg-monthly/{id}',[App\Http\Controllers\PmReportController::class,'tmgMonthly'])->name('pm-report-tmg-monthly');
    Route::get('training-material',App\Http\Livewire\TrainingMaterial\Index::class)->name('training-material.index');
    Route::get('training-material/detail-exam/{id}',App\Http\Livewire\TrainingMaterial\DetailExam::class)->name('training-material.detail-exam');
    Route::get('training-material/detail-exam-employee/{id}/{employee_id}',App\Http\Livewire\TrainingMaterial\DetailExamEmployee::class)->name('training-material.detail-exam-employee');
    Route::get('preventive-maintenance',App\Http\Livewire\PreventiveMaintenance\Index::class)->name('preventive-maintenance.index');
    Route::get('main-kpi',App\Http\Livewire\MainKpi\Index::class)->name('main-kpi.index');
    Route::get('kpi-dashboard',App\Http\Livewire\KpiDashboard\Index::class)->name('kpi-dashboard');
    Route::get('location-of-field-team',App\Http\Livewire\Locationoffieldteam\Index::class)->name('location-of-field-team.index');
    Route::get('drug-test',App\Http\Livewire\Drugtest\Index::class)->name('drug-test.index');
    Route::get('it-support',App\Http\Livewire\Itsupport\Index::class)->name('it-support.index');
    Route::get('po-management',App\Http\Livewire\Pomanagement\Index::class)->name('po-management.index');
    Route::get('lightning-strike-tracking',App\Http\Livewire\LightningStrikeTracking\Index::class)->name('lightning-strike-tracking.index');
    Route::get('duty-roster',App\Http\Livewire\DutyRoster\Index::class)->name('duty-roster.index');
    Route::get('duty-roster/preview/{id}',App\Http\Livewire\DutyRoster\Preview::class)->name('duty-roster.preview');
    Route::get('duty-roster-flmengineer',App\Http\Livewire\DutyRosterFlmengineer\Index::class)->name('duty-roster-flmengineer.index');
    Route::get('duty-roster-flmengineer/export/{id}',App\Http\Livewire\DutyRosterFlmengineer\Export::class)->name('duty-roster-flmengineer.export');
    Route::get('duty-roster-flmengineer/updateemployee',App\Http\Livewire\DutyRosterFlmengineer\Updateemployee::class)->name('duty-roster-flmengineer.updateemployee');
    Route::get('duty-roster-dophomebase',App\Http\Livewire\DutyRosterDophomebase\Index::class)->name('duty-roster-dophomebase.index');
    Route::get('duty-roster-dophomebase/preview/{id}',App\Http\Livewire\DutyRosterDophomebase\Preview::class)->name('duty-roster-dophomebase.preview');
    Route::get('application-room-request',App\Http\Livewire\ApplicationRoomRequest\Index::class)->name('application-room-request.index');
    Route::get('performance-kpi',App\Http\Livewire\PerformanceKpi\Index::class)->name('performance-kpi.index');
    Route::get('commercial-e2e',App\Http\Livewire\Commerciale2e\Index::class)->name('commercial-e2e.index');
    Route::get('trouble-ticket',App\Http\Livewire\TroubleTicket\Index::class)->name('trouble-ticket.index');
    Route::get('incident-report',App\Http\Livewire\IncidentReport\Index::class)->name('incident-report.index');
    Route::get('flm-engineer',function(){ })->name('flm-engineer.index');
    Route::get('homebase',function(){ })->name('homebase.index');
    Route::get('flm-tools',function(){ })->name('flm-tools.index');
    Route::get('region-tools',App\Http\Livewire\RegionTools\Index::class)->name('region-tools.index');
    Route::get('monitoring',App\Http\Livewire\Monitoring\Index::class)->name('monitoring.index');
    Route::get('migration',App\Http\Livewire\Migration\Index::class)->name('migration.index');
    Route::get('business-opportunities',App\Http\Livewire\BusinessOpportunities\Index::class)->name('business-opportunities.index');
    Route::get('contract-registration-flow',App\Http\Livewire\ContractRegistrationFlow\Index::class)->name('contract-registration-flow.index');
    Route::get('vendor-management',App\Http\Livewire\VendorManagement\Index::class)->name('vendor-management.index');
    Route::get('vendor-management/general-information/{id}',App\Http\Livewire\VendorManagement\Criteriageneralinformation::class)->name('vendor-management.general-information');
    Route::get('vendor-management/commercial-compliance/{id}',App\Http\Livewire\VendorManagement\Criteriacc::class)->name('vendor-management.commercial-compliance');
    Route::get('vendor-management/team-availability/{id}',App\Http\Livewire\VendorManagement\Criteriateamavailability::class)->name('vendor-management.team-availability');
    Route::get('vendor-management/tools-facilities/{id}',App\Http\Livewire\VendorManagement\Criteriatoolsfacilities::class)->name('vendor-management.tools-facilities');
    Route::get('vendor-management/ehs/{id}',App\Http\Livewire\VendorManagement\Criteriaehs::class)->name('vendor-management.ehs');
    Route::get('vendor-management/initial-general-information/{id}',App\Http\Livewire\VendorManagement\Initialgeneralinformation::class)->name('vendor-management.initial-general-information');
    Route::get('vendor-management/initial-team-availability/{id}',App\Http\Livewire\VendorManagement\Initialteamavailability::class)->name('vendor-management.initial-team-availability');
    Route::get('vendor-management/initial-tools-facilities/{id}',App\Http\Livewire\VendorManagement\Initialtoolsfacilities::class)->name('vendor-management.initial-tools-facilities');
    Route::get('vendor-management/initial-ehs/{id}',App\Http\Livewire\VendorManagement\Initialehs::class)->name('vendor-management.initial-ehs');
    Route::get('vendor-management/preview/{id}',App\Http\Livewire\VendorManagement\Servicecriteria::class)->name('vendor-management.preview');
    Route::get('duty-roster-regiontools',App\Http\Livewire\DutyRosterRegiontools\Index::class)->name('duty-roster-regiontools.index');
    Route::get('commitment-letter',App\Http\Livewire\CommitmentLetter\Index::class)->name('commitment-letter.index');
    Route::get('vehicle',App\Http\Livewire\Vehicle\Index::class)->name('vehicle.index');
    Route::get('gps-installation',App\Http\Livewire\GpsInstallation\Index::class)->name('gps-installation.index');
});