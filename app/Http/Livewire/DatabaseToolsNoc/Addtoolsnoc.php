<?php

namespace App\Http\Livewire\DatabaseToolsNoc;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Addtoolsnoc extends Component
{
    protected $listeners = [
        'modalapprovedatabasenoc'=>'approvenoc',
    ];

    use WithFileUploads;
    public $name, $nik, $tools, $software;

    
    public function render()
    {
        return view('livewire.database-tools-noc.addtoolsnoc');
    }

    public function approvenoc($id)
    {
        $this->selected_id = $id;
    }

  
    public function save()
    {
        
        $data = new \App\Models\ToolsNoc();
        $data->name = $this->name;
        $data->nik = $this->nik;
        $data->tools = $this->tools;
        $data->software = $this->software;
        
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
        //     $message .= "*Database Tools NOC ".date('M')."-".date('Y')." telah diapprove oleh Admin NOC *\n\n";
        //     send_wa(['phone'=> $phoneuser_psm[$no],'message'=>$message]);    

        //     // \Mail::to($emailuser[$no])->send(new PoTrackingReimbursementUpload($item));
        // }


       
        session()->flash('message-success',"Berhasil, Database Tools NOC berhasil ditambahkan!!!");
        
        return redirect()->route('database-tools-noc.index');
    }
}
