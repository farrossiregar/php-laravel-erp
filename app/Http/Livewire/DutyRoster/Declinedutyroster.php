<?php

namespace App\Http\Livewire\DutyRoster;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Declinedutyroster extends Component
{
    protected $listeners = [
        'modaldeclinedutyroster'=>'declinedutyroster',
    ];

    use WithFileUploads;
    public $selected_id;    
    public $note;
    // public $usertype;

    
    public function render()
    {       
        return view('livewire.duty-roster.declinedutyroster');
    }

    public function declinedutyroster($id)
    {
        $this->selected_id = $id;
    }
  
    public function save()
    {
        
        $data = \App\Models\DutyrosterSitelistMaster::where('id', $this->selected_id)->first();
        
        $data->status   = '0';
        $data->note     = $this->note;

        $data->save();

        $notif = check_access_data('duty-roster.notif-decline', '');
        $nameuser = [];
        $emailuser = [];
        $phoneuser = [];
        foreach($notif as $no => $itemuser){
            $nameuser[$no] = $itemuser->name;
            $emailuser[$no] = $itemuser->email;
            $phoneuser[$no] = $itemuser->telepon;

            $message = "*Dear Service Manager *\n\n";
            $message .= "*Duty Roster Sitelist dengan id ".$this->selected_id." perlu direvisi *\n\n";
            send_wa(['phone'=> $phoneuser[$no],'message'=>$message]);    

            // \Mail::to($emailuser[$no])->send(new PoTrackingReimbursementUpload($item));
        }

        session()->flash('message-success',"Berhasil, Duty Roster is Decline !!!");
        
        return redirect()->route('duty-roster.index');
    }
}
