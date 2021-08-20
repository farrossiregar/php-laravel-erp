<?php

namespace App\Http\Livewire\DutyRosterFlmengineer;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Previewdutyrosterflm extends Component
{
    protected $listeners = [
        'modalpreviewdutyrosterflm'=>'previewdutyroster',
    ];

    use WithFileUploads;
    public $selected_id;    
    public $data, $namepreview, $position, $account_mateline, $no_pass_id, $training_k3, $status_synergy, $total_site;

    
    public function render()
    {
       
        $namepreview = $this->namepreview;
        return view('livewire.duty-roster-flmengineer.previewdutyrosterflm');
    }

    public function previewdutyroster($id)
    {
        
        $this->selected_id = $id;

        $this->data = \App\Models\DutyrosterFlmengineerMaster::select('dutyroster_flmengineer_master.*', 'employees.name', 'employees.user_access_id', 'employees.join_date', 'employees.resign_date', 'employees.account_mateline', 'employees.no_pass_id', 'employees.training_k3', 'employees.total_site', 'employees.status_synergy', 'employees.user_access_id')
                                                                ->orderBy('dutyroster_flmengineer_master.id', 'Desc')
                                                                ->leftjoin('employees', 'employees.id', 'dutyroster_flmengineer_master.user_id')
                                                                ->where('dutyroster_flmengineer_master.id', $this->selected_id)
                                                                ->first();
        $this->namepreview = $this->data->name;

        $this->position = get_position(@$this->data->user_access_id);
        $this->account_mateline = $this->data->account_mateline;
        $this->no_pass_id = $this->data->no_pass_id;
        $this->training_k3 = $this->data->training_k3;
        $this->status_synergy = $this->data->status_synergy;
        $this->total_site = $this->data->total_site;
        
    }

  
}
