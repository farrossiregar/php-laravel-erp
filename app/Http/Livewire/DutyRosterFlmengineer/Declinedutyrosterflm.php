<?php

namespace App\Http\Livewire\DutyRosterFlmengineer;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;

class Declinedutyrosterflm extends Component
{
    protected $listeners = [
        'modaldeclinedutyroster'=>'declinedutyroster',
    ];

    use WithFileUploads;
    public $selected_id;    
    public $note;
    
    public function render()
    {       
        return view('livewire.duty-roster-flmengineer.declinedutyrosterflm');
    }

    public function declinedutyroster($id)
    {
        $this->selected_id = $id;
    }
  
    public function save()
    {
        $this->validate([
            'note'=>'required'
        ]);

        $data = \App\Models\DutyrosterFlmengineerMaster::where('id', $this->selected_id)->first();
        $data->status   = '0';
        $data->note     = $this->note;
        $data->save();

        if(isset($data->employee->email) and isset($data->user->nik)) {
            $message  = "<p>Dear {$data->employee->name}<br />Duty Roster FLM Engineer Rejected<br />NIK : {$data->user->nik}<br />Name : {$data->user->name}</p>";            
            $message .= "<p>Note : {$this->note}</p>";

            \Mail::to($data->employee->email)->send(new GeneralEmail("[PMT E-PM] - Duty Roster FLM Engineer",$message));
        }

        session()->flash('message-success',"Berhasil, Duty Roster FLM Engineer is Decline !!!");
        
        \LogActivity::add('[web] FLM Engineer Rejected');

        return redirect()->route('duty-roster-flmengineer.index');
    }
}
