<?php

namespace App\Http\Livewire\DutyRoster;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;

class Declinedutyroster extends Component
{
    protected $listeners = [
        'modaldeclinedutyroster'=>'declinedutyroster',
    ];

    use WithFileUploads;
    public $selected_id;    
    public $note;
    
    public function render()
    {       
        return view('livewire.duty-roster.declinedutyroster');
    }

    public function declinedutyroster($id)
    {
        $this->selected_id = $id;
    }
  
    public function save()
    {
        $data = \App\Models\DutyrosterSitelistMaster::where('id', $this->selected_id)->first();
        $data->status   = 3;
        $data->note     = $this->note;
        $data->save();

        // send notif to SM
        if(isset($data->employee->email)) {
            $message = "<p>Dear {$data->employee->name}<br />Your site is rejected Date Uploaded :<strong>".date('d-F-Y',strtotime($data->created_at))."</strong></p>";
            $message .= "<p>Note : {$this->note}</p>"; 
            \Mail::to($data->employee->email)->send(new GeneralEmail("[PMT E-PM] - Duty Roster Site List",$message));
        }

        session()->flash('message-success',"Berhasil, Duty Roster is Rejected !!!");
        
        return redirect()->route('duty-roster.index');
    }
}