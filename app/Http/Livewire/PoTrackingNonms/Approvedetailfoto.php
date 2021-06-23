<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Approvedetailfoto extends Component
{
    protected $listeners = [
        'modalapprovedetailfoto'=>'approvedetailfoto',
    ];

    use WithFileUploads;
    public $po_no;
    public $selected_id;
    public $status;

    public function render()
    {

        return view('livewire.po-tracking-nonms.approvedetailfoto');
    }

    public function approvedetailfoto($id)
    {
        $this->selected_id = $id;
    }

    public function save()
    {
        $status = $this->status;
        $user = \Auth::user();

        $data = \App\Models\PoTrackingNonms::where('id', $this->selected_id)->first();
        
        // if($data->type_doc == '1'){
        //     $typedoc = 'STP';
          
        // }else{
        //     $typedoc = 'BOQ';
            
        // }
        $data->bast_status = 1;
        $data->save();

      

        // $notif_user_e2e = check_access_data('po-tracking-nonms.notif-e2e', '');
        
        // $nameusere2e = [];
        // $emailusere2e = [];
        // $phoneusere2e = [];
        // foreach($notif_user_e2e as $no => $itemusere2e){
        //     $nameusere2e[$no] = $itemusere2e->name;
        //     $emailusere2e[$no] = $itemusere2e->email;
        //     $phoneusere2e[$no] = $itemusere2e->telepon;

        //     $message = "*Dear User E2E - ".$nameusere2e[$no]."*\n\n";
        //     $message .= "*PO Tracking Non MS ".$typedoc." pada ".date('d M Y H:i:s')."*\n\n";
        //     send_wa(['phone'=> $phoneusere2e[$no],'message'=>$message]);    

        //     // \Mail::to($emailusere2e[$no])->send(new PoTrackingReimbursementUpload($item));
        // }




        session()->flash('message-success',"Success!, Photo by Field Team is Approved");
        
        return redirect()->route('po-tracking-nonms.approvedetailfoto');
        
    }
}
