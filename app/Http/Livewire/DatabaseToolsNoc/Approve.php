<?php

namespace App\Http\Livewire\DatabaseToolsNoc;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Approve extends Component
{
    protected $listeners = [
        'modalapprove'=>'approve',
    ];

    use WithFileUploads;
    public $selected_id;    
    public $type;

    
    public function render()
    {

        return view('livewire.database-tools-noc.approvenoc');
    }

    public function approve($id)
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


        

        if(\App\Models\ToolsNoc::where('id', $this->selected_id)->first()->type == '1'){
            session()->flash('message-success',"Berhasil, Database Tools NOC sudah diapprove!!!");
        }else{
            session()->flash('message-success',"Berhasil, Escalation Record sudah diapprove!!!");
        }
        
        return redirect()->route('database-tools-noc.index');
    }
}
