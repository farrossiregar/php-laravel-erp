<?php

namespace App\Http\Livewire\DutyRosterDophomebase;

use Livewire\Component;
use App\Mail\GeneralEmail;

class Approvedutyroster extends Component
{
    protected $listeners = [
        'modalapprovedutyroster'=>'approvedutyroster',
    ];

    public $selected_id;    
    public $usertype;

    public function render()
    {
        return view('livewire.duty-roster-dophomebase.approvedutyroster');
    }

    public function approvedutyroster($id)
    {
        $this->selected_id = $id;
    }

    public function save()
    {
        $data = \App\Models\DophomebaseMaster::where('id', $this->selected_id)->first();
        $data->status = '1';
        $data->save();


        $message = "";
        \Mail::to("")->send(new GeneralEmail("",$message));

        $notif = check_access_data('duty-roster-dophomebase.notif-approve', '');
        $nameuser = [];
        $emailuser = [];
        $phoneuser = [];
        foreach($notif as $no => $itemuser){
            $nameuser[$no] = $itemuser->name;
            $emailuser[$no] = $itemuser->email;
            $phoneuser[$no] = $itemuser->telepon;

            $message = "*Dear SRM *\n\n";
            $message .= "*Duty Roster DOP - Homebase dengan id ".$this->selected_id." telah diapprove oleh Finance. Rental is Paid *\n\n";
            send_wa(['phone'=> $phoneuser[$no],'message'=>$message]);
        }

        session()->flash('message-success',"Berhasil, Duty Roster DOP - Homebase sudah diapprove!!!");
        
        return redirect()->route('duty-roster-dophomebase.index');
    }
}
