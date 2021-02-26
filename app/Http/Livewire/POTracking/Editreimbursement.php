<?php

namespace App\Http\Livewire\POTracking;

use Livewire\Component;
use App\Models\PoTrackingReimbursement;


class Editreimbursement extends Component
{
    protected $listeners = [
                            'update-critical'=>'updateCritical',
                            'refresh-page'=>'$refresh'
                        ];
    public $data;
    


    public function render()
    {
        // if(check_access_controller('po-tracking.edit-esar') == false){
        //     session()->flash('message-error','Access denied.');
        //     $this->redirect('/');
        // }

        // $data           = PoTrackingReimbursement::where('id_po_tracking_master', $id)->get(); 
        // if($this->date) $ata = $data->whereDate('created_at',$this->date);
        
        return view('livewire.po-tracking.edit-reimbursement');
        // return view('livewire.po-tracking.edit-esar')->with(compact('data'));
    }


    public function mount($id)
    {
        $this->data             = PoTrackingReimbursement::where('id_po_tracking_master', $id)->get();  
        
        
    }


}
