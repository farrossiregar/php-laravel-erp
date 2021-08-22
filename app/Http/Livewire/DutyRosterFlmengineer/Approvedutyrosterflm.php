<?php

namespace App\Http\Livewire\DutyRosterFlmengineer;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Approvedutyrosterflm extends Component
{
    protected $listeners = [
        'modalapprovedutyroster'=>'approvedutyroster',
    ];

    use WithFileUploads;
    public $selected_id;    
    public $usertype;

    
    public function render()
    {
        return view('livewire.duty-roster-flmengineer.approvedutyrosterflm');
    }

    public function approvedutyroster($id)
    {
        $this->selected_id = $id;
    }

  
    public function save()
    {
        $data = \App\Models\DutyrosterFlmengineerMaster::where('id', $this->selected_id)->first();
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
            $message .= "*Duty Roster FLM Engineer dengan id ".$this->selected_id." telah diapprove oleh Admin Project *\n\n";
            send_wa(['phone'=> $phoneuser[$no],'message'=>$message]);    

            // \Mail::to($emailuser[$no])->send(new PoTrackingReimbursementUpload($item));
        }


        session()->flash('message-success',"Berhasil, Duty Roster FLM Engineer sudah diapprove!!!");
        
        return redirect()->route('duty-roster-flmengineer.index');
    }
}
