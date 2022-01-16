<?php

namespace App\Http\Livewire\ClaimingProcess;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use DB;

class Decline extends Component
{
    protected $listeners = [
        'modaldeclineclaimingprocess'=>'modaldeclineclaimingprocess',
    ];

    use WithFileUploads;
    public $selected_id;    
    public $note;

    
    public function render()
    {       
        return view('livewire.claiming-process.decline');
    }

    public function modaldeclineclaimingprocess($id)
    {
        $this->selected_id = $id;
        // dd($id[0]);
    }

  
    public function save()
    {
        
       $type_approve = $this->selected_id;
        
        $data = \App\Models\ClaimingProcess::where('ticket_id', $type_approve[0])->first();
        $data->status = 0;
        $data->note     = $this->note;
        
        $data->save();


        $datahistory = new \App\Models\LogActivity();
        $datahistory->subject = 'Approvalhistoryclaimingprocess'.$type_approve[0];
        $datahistory->var = '{"status":"'.$data->status.'","note":"'.$this->note.'"}';
        $datahistory->save();

        // $message  = "<p>Dear {$data->name}<br />, Claim Request is Decline </p>";
        // \Mail::to($data->email)->send(new GeneralEmail("[PMT E-PM] - Claim Request",$message));

        session()->flash('message-success',"Berhasil, Claiming Request is Decline !!!");

        // \LogActivity::add('[web] Duty Roster - Home Base Input');
        
        return redirect()->route('claiming-process.index');
    }
}
