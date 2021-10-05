<?php

namespace App\Http\Livewire\ContractRegistrationFlow;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Wonbo extends Component
{
    protected $listeners = [
        'modalwonbo'=>'wonbo',
    ];

    use WithFileUploads;
    public $selected_id;


    
    public function render()
    {
 
        return view('livewire.business-opportunities.wonbo');
    }

    public function wonbo($id)
    {
        $this->selected_id = $id;

        
    }

  
    public function save()
    {
       
        $data = \App\Models\BusinessOpportunities::where('id', $this->selected_id)->first();
        
        $data->status   = '1';

        $data->save();

        // $notif = check_access_data('application-room-request.notif-user', '');
        // $nameuser = [];
        // $emailuser = [];
        // $phoneuser = [];
        // foreach($notif as $no => $itemuser){
        //     $nameuser[$no] = $itemuser->name;
        //     $emailuser[$no] = $itemuser->email;
        //     $phoneuser[$no] = $itemuser->telepon;

        //     $message = "*Dear User ".$nameuser."*\n\n";
        //     $message .= "*Pengajuan Room Access dengan id ".$this->selected_id." sudah diapprove *\n\n";
        //     send_wa(['phone'=> $phoneuser[$no],'message'=>$message]);    

        //     // \Mail::to($emailuser[$no])->send(new PoTrackingReimbursementUpload($item));
        // }

        session()->flash('message-success',"Berhasil, Business Opportunity status is updated to WON !!!");
        
        return redirect()->route('business-opportunities.index');
    }
}
