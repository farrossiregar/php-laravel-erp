<?php

namespace App\Http\Livewire\DutyRosterFlmengineer;

use Livewire\Component;
use App\Mail\GeneralEmail;

class Editdata extends Component
{
    protected $listeners = [
        'modaleditdutyrosterflm'=>'editdata',
    ];

    public $data, $name, $position, $account_mateline, $no_pass_id, $training_k3, $status_synergy, $total_site;

    public function render()
    {
        return view('livewire.duty-roster-flmengineer.editdata');
    }

    public function editdata($id)
    {
        $this->data = \App\Models\Employee::select('employees.*', 'user_access.name as position')
                                            ->leftjoin('user_access', 'user_access.id', 'employees.user_access_id')
                                            ->where('employees.name', $id)
                                            ->first();
        $this->name = $this->data->name;
        $this->position = $this->data->position;
        $this->account_mateline = $this->data->account_mateline;
        $this->no_pass_id = $this->data->no_pass_id;
        $this->training_k3 = $this->data->training_k3;
        $this->status_synergy = $this->data->status_synergy;
        $this->total_site = $this->data->total_site;
    }
  
    public function save()
    {
        $data = \App\Models\Employee::where('name', $this->name)->first();
        $data->account_mateline = $this->account_mateline;
        $data->no_pass_id = $this->no_pass_id;
        $data->training_k3 = $this->training_k3;
        $data->status_synergy = $this->status_synergy;
        $data->total_site = $this->total_site;
        $data->save();
        
        $datainsert = new \App\Models\DutyrosterFlmengineerMaster();
        $datainsert->user_id = $data->id;
        $datainsert->status = '';
        $datainsert->note = '';
        $datainsert->employee_id = \Auth::user()->employee->id;
        $datainsert->client_project_id = session()->get('project_id');
        $datainsert->save();

        $notif = get_user_from_access('duty-roster.approve',session()->get('project_id'));
        foreach($notif as $user){
            if($user->email){
                $message = "<p>Dear {$user->name}<br />Duty Roster FLM Engineer need your approval<br />NIK : {$data->nik}<br />Name : {$data->name}</p>";
                \Mail::to($user->email)->send(new GeneralEmail("[PMT E-PM] - Duty Roster FLM Engineer",$message));
            }
        }

        \LogActivity::add('[web] FLM Engineer Update Employee');

        session()->flash('message-success',"Data FLM Engineer Berhasil direvisi");
        
        return redirect()->route('duty-roster-flmengineer.index');
    }
}
