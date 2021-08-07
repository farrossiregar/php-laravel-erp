<?php

namespace App\Http\Livewire\DutyRoster;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Approvedutyroster extends Component
{
    protected $listeners = [
        'modalapprovedutyroster'=>'approvedutyroster',
    ];

    use WithFileUploads;
    public $selected_id;    
    public $usertype;

    
    public function render()
    {
        return view('livewire.duty-roster.approvedutyroster');
    }

    public function approvedutyroster($id)
    {
        $this->selected_id = $id;
    }

  
    public function save()
    {
        
        $data = \App\Models\DutyrosterSitelistMaster::where('id', $this->selected_id)->first();
        $data->status = '1';
        
        $data->save();

    
        $notif = check_access_data('duty-roster.notif-approve', '');
        $nameuser = [];
        $emailuser = [];
        $phoneuser = [];
        foreach($notif as $no => $itemuser){
            $nameuser[$no] = $itemuser->name;
            $emailuser[$no] = $itemuser->email;
            $phoneuser[$no] = $itemuser->telepon;

            $message = "*Dear SRM *\n\n";
            $message .= "*Duty Roster Sitelist dengan id ".$this->selected_id." telah diapprove oleh Admin Project *\n\n";
            send_wa(['phone'=> $phoneuser[$no],'message'=>$message]);    

            // \Mail::to($emailuser[$no])->send(new PoTrackingReimbursementUpload($item));
        }


        session()->flash('message-success',"Berhasil, Duty Roster sudah diapprove!!!");
        
        return redirect()->route('duty-roster.index');
    }
}
