<?php

namespace App\Http\Livewire\DanaStpl;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Approvedana extends Component
{
    protected $listeners = [
        'modalapprovedana'=>'approvedana',
    ];

    use WithFileUploads;
    public $selected_id;    
    public $usertype;

    
    public function render()
    {
        return view('livewire.dana-stpl.approvestpl');
    }

    public function approvedana($id)
    {
        $this->selected_id = $id;
    }

  
    public function save()
    {
        
        $data = \App\Models\DanaStpl::where('id', $this->selected_id)->first();
        
        if(check_access('dana-stpl.approve-sm')){
            $data->status   = '1';
            $sender = 'SM';
            $target_user = 'Manager Security';
            $notif_user = check_access_data('dana-stpl.approve-ms', '');
            $msg = "*Dana Stpl dengan id ".$this->selected_id." telah diapprove oleh ".$sender." dan menunggu approval dari ".$target_user."*\n\n";
        }elseif(check_access('dana-stpl.approve-ms')){
            $data->status   = '2';
            $sender = 'Manager Security';
            $target_user = 'PSM';
            $notif_user = check_access_data('dana-stpl.approve-psm', '');
            $msg = "*Dana Stpl dengan id ".$this->selected_id." telah diapprove oleh ".$sender." dan menunggu approval dari ".$target_user."*\n\n";
        }else{
            $data->status   = '3';
            $sender = 'PSM';
            $target_user = 'Admin Project';
            $notif_user = check_access_data('input-dana-stpl', '');
            $msg = "*Dana Stpl dengan id ".$this->selected_id." telah diapprove oleh ".$sender."*\n\n";
        }

        
        $data->save();

    
        
        $nameuser = [];
        $emailuser = [];
        $phoneuser = [];
        foreach($notif_user as $no => $itemuser){
            $nameuser[$no] = $itemuser->name;
            $emailuser[$no] = $itemuser->email;
            $phoneuser[$no] = $itemuser->telepon;

            $message = "*Dear ".$target_user." - ".$nameuser[$no]."*\n\n";
            $message .= $msg;
            send_wa(['phone'=> $phoneuser[$no],'message'=>$message]);    

            // \Mail::to($emailuser[$no])->send(new PoTrackingReimbursementUpload($item));
        }

        session()->flash('message-success',"Berhasil, Dana sudah diapprove!!!");
        
        return redirect()->route('dana-stpl.index');
    }
}
