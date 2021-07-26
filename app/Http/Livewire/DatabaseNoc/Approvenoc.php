<?php

namespace App\Http\Livewire\DatabaseNoc;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Approvenoc extends Component
{
    protected $listeners = [
        'modalapprovedatabasenoc'=>'approvenoc',
    ];

    use WithFileUploads;
    public $selected_id;    
    public $usertype;

    
    public function render()
    {
        return view('livewire.database-noc.approvenoc');
    }

    public function approvenoc($id)
    {
        $this->selected_id = $id;
    }

  
    public function save()
    {
        
        $data = \App\Models\EmployeeNoc::where('id', $this->selected_id)->first();
        $data->status = '1';
        
        $data->save();

    
        
        // $nameuser = [];
        // $emailuser = [];
        // $phoneuser = [];
        // foreach($notif_user as $no => $itemuser){
        //     $nameuser[$no] = $itemuser->name;
        //     $emailuser[$no] = $itemuser->email;
        //     $phoneuser[$no] = $itemuser->telepon;

        //     $message = "*Dear ".$target_user." - ".$nameuser[$no]."*\n\n";
        //     $message .= $msg;
        //     send_wa(['phone'=> $phoneuser[$no],'message'=>$message]);    

        //     // \Mail::to($emailuser[$no])->send(new PoTrackingReimbursementUpload($item));
        // }

        session()->flash('message-success',"Berhasil, Database NOC sudah diapprove!!!");
        
        return redirect()->route('database-noc.index');
    }
}
