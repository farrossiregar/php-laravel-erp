<?php

namespace App\Http\Livewire\DatabaseToolsNoc;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Decline extends Component
{
    protected $listeners = [
        'modaldecline'=>'decline',
    ];

    use WithFileUploads;
    public $selected_id;    
    public $note;
    public $type;

    
    public function render()
    {       
        return view('livewire.database-tools-noc.declinenoc');
    }

    public function decline($id)
    {
        $this->selected_id = $id;
        if(\App\Models\ToolsNoc::where('id', $this->selected_id)->first()->type == '1'){
            $this->type = 'Database Tools NOC';
        }else{
            $this->type = 'Escalation Record';
        }
    }
  
    public function save()
    {
        // dd($this->selected_id);
        $data = \App\Models\ToolsNoc::where('id', $this->selected_id)->first();
        
        $data->status   = '0';
        $data->note     = $this->note;

        $data->save();

        // $notif = check_access_data('duty-roster-dophomebase.notif-decline', '');
        // $nameuser = [];
        // $emailuser = [];
        // $phoneuser = [];
        // foreach($notif as $no => $itemuser){
        //     $nameuser[$no] = $itemuser->name;
        //     $emailuser[$no] = $itemuser->email;
        //     $phoneuser[$no] = $itemuser->telepon;

        //     $message = "*Dear HRD GA *\n\n";
        //     $message .= "*Duty Roster DOP - Homebase dengan id ".$this->selected_id." perlu direvisi *\n\n";
        //     send_wa(['phone'=> $phoneuser[$no],'message'=>$message]);    

        //     // \Mail::to($emailuser[$no])->send(new PoTrackingReimbursementUpload($item));
        // }

        if(\App\Models\ToolsNoc::where('id', $this->selected_id)->first()->type == '1'){
            session()->flash('message-success',"Berhasil, Database Tools NOC sudah didecline!!!");
        }else{
            session()->flash('message-success',"Berhasil, Escalation Record sudah didecline!!!");
        }
        
        
        return redirect()->route('database-tools-noc.index');
    }
}
