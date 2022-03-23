<?php

namespace App\Http\Livewire\DutyRosterDophomebase;

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
        return view('livewire.duty-roster-dophomebase.declinedutyroster');
    }

    public function declinedutyroster($id)
    {
        $this->selected_id = $id;
    }
  
    public function save()
    {   
        $data = \App\Models\DopHomebaseMaster::where('id', $this->selected_id)->first();   
        $data->status   = '0';
        $data->note     = $this->note;
        $data->save();

        if(isset($data->employee->email)) {
            $message = "<p>Dear {$data->employee->name}<br />DOP Home Base is rejected </p>";
            $message .= "<p>Nama DOP: {$data->nama_dop}<br />Project : {$data->project}<br />Region: {$data->region}</p>";
            $message .= "<p>Note: {$this->note}</p>";

            \Mail::to($data->employee->email)->send(new GeneralEmail("[PMT E-PM] - Duty Roster Home Base",$message));
        }

        session()->flash('message-success',"Berhasil, Duty Roster DOP - Homebase is rejected");
        
        return redirect()->route('duty-roster-dophomebase.index');
    }
}