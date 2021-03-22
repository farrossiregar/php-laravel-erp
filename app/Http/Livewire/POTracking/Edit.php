<?php

namespace App\Http\Livewire\POTracking;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PoTrackingPds;
use App\Models\PoTrackingReimbursement;
use App\Models\PoTrackingReimbursementEsarupload;


class Edit extends Component
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
        
        $data = PoTrackingReimbursementEsarupload::where('po_tracking_reimbursement_esarupload.id_po_tracking_master', $this->id)
                                                                    ->join('po_tracking_reimbursement', 'po_tracking_reimbursement.id_po_tracking_master', '=', 'po_tracking_reimbursement_esarupload.id_po_tracking_master')
                                                                    ->groupBy('po_tracking_reimbursement.po_no');
                                                                    // ->get();  
        // $data           = $this->data;
        if($this->status){
            if($this->status == '1'){
                $ata = $data->where('po_tracking_reimbursement_esarupload.approved_esar_filename', '!=', '');
            }else{
                $ata = $data->where('po_tracking_reimbursement_esarupload.approved_esar_filename', '');
            }   
        }else{
            $data;
        }
        

        return view('livewire.po-tracking.edit');
        // return view('livewire.po-tracking.edit')->with(compact('data'));
        return view('livewire.po-tracking.index')->with(['data'=>$data->paginate(50)]);
    }


    public function mount($id)
    {
        $this->data             = PoTrackingReimbursementEsarupload::where('po_tracking_reimbursement_esarupload.id_po_tracking_master', $id)
                                                                    ->join('po_tracking_reimbursement', 'po_tracking_reimbursement.id_po_tracking_master', '=', 'po_tracking_reimbursement_esarupload.id_po_tracking_master')
                                                                    ->groupBy('po_tracking_reimbursement.po_no')
                                                                    ->get();  

        $this->id = $id;
        
        
        
    }

    
}
