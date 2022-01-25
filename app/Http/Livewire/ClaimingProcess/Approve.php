<?php

namespace App\Http\Livewire\ClaimingProcess;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use DB;

class Approve extends Component
{
    protected $listeners = [
        'modalapproveclaimingprocess'=>'modalapproveclaimingprocess',
    ];

    use WithFileUploads;
    public $selected_id, $note;    
    public $usertype;

    
    public function render()
    {
        return view('livewire.claiming-process.approve');
    }

    public function modalapproveclaimingprocess($id)
    {
        $this->selected_id = $id;
    }

  
    public function save()
    {
        $type_approve = $this->selected_id;
        
        $data = \App\Models\ClaimingProcess::where('ticket_id', $type_approve[0])->first();
        $data->status = $type_approve[1];
        $data->note     = $this->note;
        
        $data->save();


        $datahistory = new \App\Models\LogActivity();
        $datahistory->subject = 'Approvalhistoryclaimingprocess'.$type_approve[0];
        $datahistory->var = '{"status":"'.$data->status.'","note":"'.$this->note.'"}';
        $datahistory->save();


        session()->flash('message-success',"Berhasil, Claiming Process sudah diapprove!!!");
        
        return redirect()->route('claiming-process.index');
    }
}
