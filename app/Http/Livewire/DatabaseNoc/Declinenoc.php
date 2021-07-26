<?php

namespace App\Http\Livewire\DatabaseNoc;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Declinenoc extends Component
{
    protected $listeners = [
        'modaldeclinedatabasenoc'=>'declinenoc',
    ];

    use WithFileUploads;
    public $selected_id;    
    public $note;
    // public $usertype;

    
    public function render()
    {       
        return view('livewire.database-noc.declinenoc');
    }

    public function declinenoc($id)
    {
        $this->selected_id = $id;
    }
  
    public function save()
    {
        
        $data = \App\Models\EmployeeNoc::where('id', $this->selected_id)->first();
        
        $data->status   = '0';
        $data->note     = $this->note;

        $data->save();

        // $notifuser = check_access_data('input-dana-stpl', '');       
        
        // foreach($notifuser as $no => $itemuser){
        //     $nameuser = $itemuser->name;
        //     $emailuser = $itemuser->email;
        //     $phoneuser = $itemuser->telepon;
        //     $message = "*Dear Admin Project - ".$nameuser."*\n\n";
        //     $message .= "*Dana Stpl dengan id ".$this->selected_id." perlu direvisi";
        //     send_wa(['phone'=> $phoneuser,'message'=>$message]);   

        //     // \Mail::to($emailuser)->send(new PoTrackingReimbursementUpload($item));
        // }


        session()->flash('message-success',"Berhasil, Database NOC is Decline !!!");
        
        return redirect()->route('database-noc.index');
    }
}
