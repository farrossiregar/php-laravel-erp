<?php

namespace App\Http\Livewire\DanaStpl;

use Livewire\Component;
use App\Models\Project;
use App\Models\DanaStpl;

class Revisidana extends Component
{

    protected $listeners = [
        'modalrevisidana'=>'revisidana',
    ];

    public $detaildana;
    public $danastpl;
    public $project_id_edit;
    public $project_name;
    public $projectcode_edit;
    public $region;
    public $sm;
    public $selected_id,$projects;

    public function render()
    {
        return view('livewire.dana-stpl.revisidana');
    }

    public function revisidana(DanaStpl $id)
    {
        $this->selected_id = $id;
        $this->detaildana = DanaStpl::select('dana_stpl_master.*', 'region.region_code', 'employees.name as sm_name', 'employees.id as sm_id')
                                                ->join(env('DB_DATABASE_EPL_PMT').'.region as region', 'region.id', 'dana_stpl_master.region_id')
                                                ->leftjoin(env('DB_DATABASE').'.employees as employees', 'employees.id', 'dana_stpl_master.sm_id')
                                                ->where('dana_stpl_master.id', $this->selected_id->id)
                                                ->first();

        $this->danastpl = $this->detaildana->danastpl;
        $this->project_id = $this->detaildana->project_id;
        $this->project_name = isset($this->detaildana->project->name) ? $this->detaildana->project->name : '';
        $this->region = $this->detaildana->region_code;
        $this->sm = $this->detaildana->sm_name;
        $this->sm_id = $this->detaildana->sm_id;
        $this->region_id = $this->detaildana->region_id;
    }
  
    public function save()
    {
        $this->selected_id->danastpl = $this->danastpl;
        $this->selected_id->status = null;
        $this->selected_id->save();

        session()->flash('message-success',"Dana Berhasil direvisi");
        
        return redirect()->route('dana-stpl.index');
    }
}
