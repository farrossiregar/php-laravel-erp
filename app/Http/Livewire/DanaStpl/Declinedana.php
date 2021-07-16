<?php

namespace App\Http\Livewire\DanaStpl;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Declinedana extends Component
{
    protected $listeners = [
        'modaldeclinedana'=>'declinedana',
    ];

    use WithFileUploads;
    public $selected_id;    
    public $note;
    // public $usertype;

    
    public function render()
    {       
        return view('livewire.dana-stpl.declinestpl');
    }

    public function declinedana($id)
    {
        $this->selected_id = $id;
    }
  
    public function save()
    {
        
        $data = \App\Models\DanaStpl::where('id', $this->selected_id)->first();
        
        $data->status   = '0';
        $data->note     = $this->note;

        $data->save();

        $notifuser = check_access_data('input-dana-stpl', '');       
        
        foreach($notifuser as $no => $itemuser){
            $nameuser = $itemuser->name;
            $emailuser = $itemuser->email;
            $phoneuser = $itemuser->telepon;
            $message = "*Dear Admin Project - ".$nameuser."*\n\n";
            $message .= "*Dana Stpl dengan id ".$this->selected_id." perlu direvisi";
            send_wa(['phone'=> $phoneuser,'message'=>$message]);   

            // \Mail::to($emailuser)->send(new PoTrackingReimbursementUpload($item));
        }


        session()->flash('message-success',"Berhasil, Dana STPL is Decline !!!");
        
        return redirect()->route('dana-stpl.index');
    }
}
