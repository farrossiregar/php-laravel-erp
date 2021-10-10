<?php

namespace App\Http\Livewire\BusinessOpportunities;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Failedbo extends Component
{
    protected $listeners = [
        'modalfailedbo'=>'failedbo',
    ];

    use WithFileUploads;
    public $selected_id;    
    public $note;
    // public $usertype;

    
    public function render()
    {       
        return view('livewire.business-opportunities.failedbo');
    }

    public function failedbo($id)
    {
        $this->selected_id = $id;
 
    }
  
    public function save()
    {
        
        $data = \App\Models\BusinessOpportunities::where('id', $this->selected_id)->first();
        
        $data->status   = '0';
        $data->note     = $this->note;

        $data->save();

        
        // $notif = check_access_data('application-room-request.notif-user', '');
        // $nameuser = [];
        // $emailuser = [];
        // $phoneuser = [];
        // foreach($notif as $no => $itemuser){
        //     $nameuser[$no] = $itemuser->name;
        //     $emailuser[$no] = $itemuser->email;
        //     $phoneuser[$no] = $itemuser->telepon;

        //     send_wa(['phone'=> $phoneuser[$no],'message'=>$message]);    

        //     // \Mail::to($emailuser[$no])->send(new PoTrackingReimbursementUpload($item));
        // }

        session()->flash('message-success',"Berhasil, Business Opportunity status is updated to Failed !!!");
        
        return redirect()->route('business-opportunities.index');
    }
}
