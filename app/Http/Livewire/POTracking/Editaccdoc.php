<?php

namespace App\Http\Livewire\POTracking;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PoTrackingPds;
use App\Models\PoTrackingReimbursement;
use App\Models\PoTrackingReimbursementEsarupload;
use App\Models\PoTrackingReimbursementBastupload;
use App\Models\PoTrackingReimbursementAccdocupload;
use App\Models\Region;
use App\Models\User;
use App\Models\UserEpl;
use DB;


class Editaccdoc extends Component
{

    public $data;
    public $status;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    


    public function render()
    {

        return view('livewire.po-tracking.edit-accdoc');
    }


    public function mount($id)
    {
        $user = \Auth::user();

        $this->data             = DB::table(env('DB_DATABASE').'.po_tracking_reimbursement as po_tracking_reimbursement')
                                            // ->select('po_tracking_reimbursement.po_no', 'po_tracking_reimbursement.bidding_area', 'po_tracking_reimbursement_bastupload.bast_uploader_userid', 'po_tracking_reimbursement_bastupload.bast_filename', 'po_tracking_reimbursement_bastupload.status')
                                            ->leftjoin(env('DB_DATABASE').'.po_tracking_reimbursement_accdocupload as po_tracking_reimbursement_accdocupload', 'po_tracking_reimbursement.po_no', '=', 'po_tracking_reimbursement_accdocupload.po_no')
                                            ->leftjoin(env('DB_DATABASE').'.po_tracking_reimbursement_esarupload as po_tracking_reimbursement_esarupload', 'po_tracking_reimbursement.po_no', '=', 'po_tracking_reimbursement_esarupload.po_no')
                                            ->where('po_tracking_reimbursement.id_po_tracking_master', $id)
                                            ->groupBy('po_tracking_reimbursement.po_no')
                                            ->get(); 

        
        

        $this->id = $id;
        
        
        
    }

    
}
