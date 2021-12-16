<?php

namespace App\Http\Livewire\DutyRosterFlmengineer;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;

class Approvedutyrosterflm extends Component
{
    protected $listeners = [
        'modalapprovedutyroster'=>'approvedutyroster',
    ];

    use WithFileUploads;
    public $selected_id;    
    public $usertype;

    
    public function render()
    {
        return view('livewire.duty-roster-flmengineer.approvedutyrosterflm');
    }

    public function approvedutyroster($id)
    {
        $this->selected_id = $id;
    }
  
    public function save()
    {
        $data = \App\Models\DutyrosterFlmengineerMaster::where('id', $this->selected_id)->first();
        $data->status = 1;
        $data->save();

        if(isset($data->employee->email) and isset($data->user->nik)) {
            $message = "<p>Dear {$data->employee->name}<br />Duty Roster FLM Engineer Approved<br />NIK : {$data->user->nik}<br />Name : {$data->user->name}</p>";            
            \Mail::to($data->employee->email)->send(new GeneralEmail("[PMT E-PM] - Duty Roster FLM Engineer",$message));
        }

        $notif = get_user_from_access('duty-roster.audit',session()->get('project_id'));
        foreach($notif as $user){
            if($user->email){
                $message = "<p>Dear {$user->name}<br />Duty Roster FLM Engineer need your audit<br />NIK : {$data->nik}<br />Name : {$data->name}</p>";
                \Mail::to($user->email)->send(new GeneralEmail("[PMT E-PM] - Duty Roster FLM Engineer",$message));
            }
        }

        session()->flash('message-success',"Berhasil, Duty Roster FLM Engineer sudah diapprove!!!");
        
        \LogActivity::add('[web] FLM Engineer Approve');

        return redirect()->route('duty-roster-flmengineer.index');
    }
}