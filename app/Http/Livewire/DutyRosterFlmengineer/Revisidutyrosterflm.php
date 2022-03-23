<?php

namespace App\Http\Livewire\DutyRosterFlmengineer;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Revisidutyrosterflm extends Component
{
    protected $listeners = [
        'modalrevisidutyrosterflm'=>'revisidutyroster',
    ];

    use WithFileUploads;
    public $selected_id;    
    public $data, $name, $position, $account_mateline, $no_pass_id, $training_k3, $status_synergy, $total_site;

    
    public function render()
    {
       
        
        return view('livewire.duty-roster-flmengineer.revisidutyrosterflm');
    }

    public function revisidutyroster($id)
    {
        
        $this->selected_id = $id;
        

        $this->data = \App\Models\DutyrosterFlmengineerMaster::select('dutyroster_flmengineer_master.*', 'employees.name', 'employees.user_access_id', 'employees.join_date', 'employees.resign_date', 'employees.account_mateline', 'employees.no_pass_id', 'employees.training_k3', 'employees.total_site', 'employees.status_synergy', 'employees.user_access_id')
                                                                ->orderBy('dutyroster_flmengineer_master.id', 'Desc')
                                                                ->leftjoin('employees', 'employees.id', 'dutyroster_flmengineer_master.user_id')
                                                                ->where('dutyroster_flmengineer_master.id', $this->selected_id)
                                                                ->first();
        $this->name = $this->data->name;

        $this->position = get_position(@$this->data->user_access_id);
        $this->account_mateline = $this->data->account_mateline;
        $this->no_pass_id = $this->data->no_pass_id;
        $this->training_k3 = $this->data->training_k3;
        $this->status_synergy = $this->data->status_synergy;
        $this->total_site = $this->data->total_site;
        
    }

  
    public function save()
    {
        $dataupdate = \App\Models\Employee::
                                            select('dutyroster_flmengineer_master.*', 'employees.name', 'employees.user_access_id', 'employees.join_date', 'employees.resign_date', 'employees.account_mateline', 'employees.no_pass_id', 'employees.training_k3', 'employees.total_site', 'employees.status_synergy', 'employees.user_access_id')
                                            ->leftjoin('dutyroster_flmengineer_master', 'employees.id', 'dutyroster_flmengineer_master.user_id')
                                            ->where('dutyroster_flmengineer_master.id', $this->selected_id)
                                            ->first();

        
        $dataupdate->account_mateline   = $this->account_mateline;
        $dataupdate->no_pass_id         = $this->no_pass_id;
        $dataupdate->training_k3        = $this->training_k3;
        $dataupdate->status_synergy     = $this->status_synergy;
        $dataupdate->total_site         = $this->total_site;

        // dd($this);
        $dataupdate->save();

        // $datamaster = \App\Models\DutyrosterFlmengineerMaster::where('id', $this->selected_id)->first();
        // $datamaster->note = '';
        // $datamaster->status = '';
        // $datamaster->save();
        
        
        session()->flash('message-success',"Berhasil, Duty Roster FLM Engineer sudah direvisi!!!");
        
        return redirect()->route('duty-roster-flmengineer.index');
    }
}
