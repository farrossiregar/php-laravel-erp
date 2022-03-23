<?php

namespace App\Http\Livewire\PettyCash;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Approvereceipt extends Component
{
    protected $listeners = [
        'modalapprovereceipt'=>'approvereceipt',
    ];

    use WithFileUploads;
    public $selected_id, $note;    
    public $usertype;

    
    public function render()
    {
        return view('livewire.petty-cash.approvereceipt');
    }

    public function approvereceipt($id)
    {
        $this->selected_id = $id;
    }

  
    public function save()
    {
        
        $data = \App\Models\PettyCash::where('id', $this->selected_id)->first();
        $data->status_receipt = '1';
        $data->note_receipt     = $this->note;
        $data->save();

        $datahistory            = new \App\Models\LogActivity();
        $datahistory->subject   = 'Approvalhistorypettycash'.$this->selected_id;
        $datahistory->var       = '{"status":"'.$data->status_receipt.'","note":"'.$this->note.'","type":"receipt"}';
        $datahistory->save();

    
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




        session()->flash('message-success',"Berhasil, Petty Cash sudah diapprove!!!");
        
        return redirect()->route('petty-cash.index');
    }
}
