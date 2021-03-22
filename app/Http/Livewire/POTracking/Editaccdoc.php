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

        $data = $this->data;
        return view('livewire.po-tracking.edit-accdoc')->with(compact('data'));
    }


    public function mount($id)
    {
        $user = \Auth::user();

        $this->data             = PoTrackingReimbursementAccdocupload::where('po_tracking_reimbursement_accdocupload.id_po_tracking_master', $id)
                                                                    ->leftjoin('po_tracking_reimbursement', 'po_tracking_reimbursement.id_po_tracking_master', '=', 'po_tracking_reimbursement_accdocupload.id_po_tracking_master')
                                                                    ->groupBy('po_tracking_reimbursement.po_no')
                                                                    ->get();  
        

        $this->id = $id;
        
        
        
    }

    
}
