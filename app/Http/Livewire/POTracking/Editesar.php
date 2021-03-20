<?php

namespace App\Http\Livewire\POTracking;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PoTrackingPds;
use App\Models\PoTrackingReimbursement;
use App\Models\PoTrackingReimbursementEsarupload;
use Auth;


class Editesar extends Component
{

    public $data;
    public $status;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    


    public function render()
    {
        // if(check_access_controller('po-tracking.edit') == false){
        //     session()->flash('message-error','Access denied.');
        //     $this->redirect('/');
        // }
        
        $data = PoTrackingReimbursementEsarupload::select('po_tracking_reimbursement_esarupload.approved_esar_filename as approved_esar_filename', 'po_tracking_reimbursement.po_no as po_no', 'po_tracking_reimbursement.project_name as project_name', 'po_tracking_reimbursement.project_code as project_code', 'po_tracking_reimbursement.acceptance_date as acceptance_date', 'po_tracking_reimbursement.sub_contract_no as sub_contract_no')
                                                    ->where('po_tracking_reimbursement_esarupload.id_po_tracking_master', $this->id)
                                                    ->join('po_tracking_reimbursement', 'po_tracking_reimbursement_esarupload.id_po_tracking_master', '=', 'po_tracking_reimbursement.id_po_tracking_master');
                                                    
                                                                   
        if($this->status == '1'){
            // $ata = $data->where('po_tracking_reimbursement_esarupload.approved_esar_filename', '!=', '');
            $data = $data->whereNotNull('po_tracking_reimbursement_esarupload.approved_esar_filename');
        }else{
            $data = $data->whereNull('po_tracking_reimbursement_esarupload.approved_esar_filename');
            // $ata = $data->where('po_tracking_reimbursement_esarupload.approved_esar_filename', '');
        }   
        
        $data = $data->groupBy('po_tracking_reimbursement_esarupload.po_no');

        
        return view('livewire.po-tracking.edit-esar')->with(['data'=>$data->paginate(50)]);
    }


    public function mount($id)
    {
        

        $this->data             = PoTrackingReimbursementEsarupload::where('po_tracking_reimbursement_esarupload.id_po_tracking_master', $id)
                                                                    ->join('po_tracking_reimbursement', 'po_tracking_reimbursement_esarupload.id_po_tracking_master', '=', 'po_tracking_reimbursement.id_po_tracking_master')
                                                                    ->groupBy('po_tracking_reimbursement_esarupload.po_no')
                                                                    ->get();  

        $this->id = $id;
        
        
        
    }

    
}
