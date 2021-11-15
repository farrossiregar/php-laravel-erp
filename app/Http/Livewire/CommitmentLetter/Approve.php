<?php

namespace App\Http\Livewire\CommitmentLetter;

use Livewire\Component;
use App\Models\ApplicationRoomRequest;

class Approve extends Component
{
    protected $listeners = [
        'modalapprovecommitmentletter'=>'approvecommitmentletter',
    ];

    public $selected_id;

    public function render()
    {
        return view('livewire.commitment-letter.approve');
    }

    public function approvecommitmentletter($id)
    {
        $this->selected_id = $id;
    }

    public function save()
    {
        $data = \App\Models\CommitmentLetter::where('id', $this->selected_id)->first();
        $data->status = '1';
        $data->save();
    
        // $notif = check_access_data('duty-roster-dophomebase.notif-approve', '');
        // $nameuser = [];
        // $emailuser = [];
        // $phoneuser = [];
        // foreach($notif as $no => $itemuser){
        //     $nameuser[$no] = $itemuser->name;
        //     $emailuser[$no] = $itemuser->email;
        //     $phoneuser[$no] = $itemuser->telepon;

        //     $message = "*Dear SRM *\n\n";
        //     $message .= "*Duty Roster DOP - Homebase dengan id ".$this->selected_id." telah diapprove oleh Finance. Rental is Paid *\n\n";
        //     send_wa(['phone'=> $phoneuser[$no],'message'=>$message]);    

        //     // \Mail::to($emailuser[$no])->send(new PoTrackingReimbursementUpload($item));
        // }


        session()->flash('message-success',"Berhasil, Commitment Letter is Approve !!!");
        
        return redirect()->route('commitment-letter.index');

        
    }
}
