<?php

namespace App\Http\Livewire\TeamSchedule;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Approvepettycash extends Component
{
    protected $listeners = [
        'modalapprovepettycash'=>'approvepettycash',
    ];

    use WithFileUploads;
    public $selected_id;    
    public $usertype;

    
    public function render()
    {
        return view('livewire.team-schedule.approve');
    }

    public function approvepettycash($id)
    {
        $this->selected_id = $id;
    }

  
    public function save()
    {
        
        $data = \App\Models\PettyCash::where('id', $this->selected_id)->first();
        $data->status = '1';
        
        $data->save();

    
        $notif = check_access_data('petty-cash.notif', '');
        $nameuser = [];
        $emailuser = [];
        $phoneuser = [];
        foreach($notif as $no => $itemuser){
            $nameuser_[$no] = $itemuser->name;
            $emailuser[$no] = $itemuser->email;
            $phoneuser[$no] = $itemuser->telepon;

            $message = "*Dear Admin NOC *\n\n";
            $message .= "*Petty Cash ".date('M')."-".date('Y')." telah diapprove oleh Finance *\n\n";
            send_wa(['phone'=> $phoneuser[$no],'message'=>$message]);    

            // \Mail::to($emailuser[$no])->send(new PoTrackingReimbursementUpload($item));
        }



        session()->flash('message-success',"Berhasil, Petty Cash sudah diapprove!!!");
        
        return redirect()->route('petty-cash.index');
    }
}
