<?php

namespace App\Http\Livewire\POTracking;

use Livewire\Component;
use App\Models\PoTrackingPds;
use App\Models\PoTrackingReimbursement;
use App\Models\PoTrackingReimbursementEsarupload;


class Edit extends Component
{

    public $data;
    


    public function render()
    {
        // if(check_access_controller('po-tracking.edit') == false){
        //     session()->flash('message-error','Access denied.');
        //     $this->redirect('/');
        // }

        $data           = $this->data;
        return view('livewire.po-tracking.edit')->with(compact('data'));
    }


    public function mount($id)
    {
        $this->data             = PoTrackingReimbursementEsarupload::where('id_po_tracking_master', $id)->get();  
        
        
    }

    
}
