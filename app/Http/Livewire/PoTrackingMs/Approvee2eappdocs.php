<?php

namespace App\Http\Livewire\PoTrackingMs;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Approvee2eappdocs extends Component
{
    protected $listeners = [
        'modalapprovee2eappdocs'=>'approvee2eappdocs',
    ];

    use WithFileUploads;
    public $selected_id;    
    public $note;
    // public $usertype;

    
    public function render()
    {       
        
        return view('livewire.po-tracking-ms.approvee2eappdocs');
    }

    public function approvee2eappdocs($id)
    {
        $this->selected_id = $id;
 
    }
  
    public function save()
    {
        
        $data = \App\Models\PoTrackingMs::where('id', $this->selected_id)->first();
        
        $data->status   = '1';
        // $data->note     = $this->note;

        $data->save();

        // if($data->type_request == 'Application'){
        //     $message = "*Dear User ".$data->employee_name."*\n\n";
        //     $message .= "*Pengajuan Application Access dengan id ".$this->selected_id." tidak disetujui *\n\n";
        //     $alert = "Berhasil, Pengajuan Application Access is Decline !!!";
        // }

        // if($data->type_request == 'Room'){
        //     $message = "*Dear User ".$nameuser."*\n\n";
        //     $message .= "*Pengajuan Room Access dengan id ".$this->selected_id." tidak disetujui *\n\n";
        //     $alert = "Berhasil, Pengajuan Room Access is Decline !!!";
        // }

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

        // session()->flash('message-success',$alert);
        
        return redirect()->route('po-tracking-ms.index');
    }
}
