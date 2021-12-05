<?php

namespace App\Http\Livewire\PettyCash;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Declinereceipt extends Component
{
    protected $listeners = [
        'modaldeclinereceipt'=>'declinereceipt',
    ];

    use WithFileUploads;
    public $selected_id;    
    public $note;

    
    public function render()
    {       
        return view('livewire.petty-cash.declinereceipt');
    }

    public function declinereceipt($id)
    {
        $this->selected_id = $id;
    }

  
    public function save()
    {
        
        $data = \App\Models\PettyCash::where('id', $this->selected_id)->first();
        
        $data->status_receipt = '0';
        $data->note_receipt     = $this->note;

        $data->save();


        // $notif_user_psm = check_access_data('database-noc.notif-psm', '');
        // $nameuser_psm = [];
        // $emailuser_psm = [];
        // $phoneuser_psm = [];
        // foreach($notif_user_psm as $no => $itemuser){
        //     $nameuser_psm[$no] = $itemuser->name;
        //     $emailuser_psm[$no] = $itemuser->email;
        //     $phoneuser_psm[$no] = $itemuser->telepon;

        //     $message = "*Dear PSM *\n\n";
        //     $message .= "*Database NOC ".date('M')."-".date('Y')." telah diapprove oleh Admin NOC *\n\n";
        //     send_wa(['phone'=> $phoneuser_psm[$no],'message'=>$message]);    

        //     // \Mail::to($emailuser[$no])->send(new PoTrackingReimbursementUpload($item));
        // }


        

        session()->flash('message-success',"Berhasil, Petty Cash is Decline !!!");
        
        return redirect()->route('petty-cash.index');
    }
}
