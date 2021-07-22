<?php

namespace App\Http\Livewire\DanaStpl;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Revisidana extends Component
{

    protected $listeners = [
        'modalrevisidana'=>'revisidana',
    ];

    use WithFileUploads;
    public $detaildana;
    public $danastpl;
    public $project_id_edit;
    public $project_name_edit;
    public $projectcode_edit;
    public $region_edit;
    public $sm_edit;
    public $selected_id;

    
    public function render()
    {
        
        return view('livewire.dana-stpl.revisidana');
    }

    public function revisidana($id)
    {
        $this->selected_id = $id;
        $this->detaildana = \App\Models\DanaStpl::select('dana_stpl_master.*', 'region.region_code', 'employees.name')
                                                ->join(env('DB_DATABASE_EPL_PMT').'.region as region', 'region.id', 'dana_stpl_master.region_id')
                                                ->leftjoin(env('DB_DATABASE').'.employees as employees', 'employees.id', 'dana_stpl_master.sm_id')
                                                ->where('dana_stpl_master.id', $this->selected_id)
                                                ->first();
        $this->danastpl = $this->detaildana->danastpl;
        $this->project_id = $this->detaildana->project_id;
        $this->project_name_edit = $this->detaildana->project_name;
        $this->region_edit = $this->detaildana->region_code;
        $this->sm_edit = $this->detaildana->name;
    }
  
    public function save()
    {
        // dd($this->projectcode);
        $edit = \App\Models\DanaStpl::where('id', $this->selected_id)->first();

        $data = \App\Models\Project::select('projects.*', 'region_code as region_name', 'employees.name as sm_name', 'employees.id as smid')
                ->join(env('DB_DATABASE_EPL_PMT').'.region as region', 'region.id', 'projects.region_id')
                ->leftjoin(env('DB_DATABASE').'.employees as employees', 'employees.id', 'projects.project_manager_id')
                ->where('projects.id', '9')
                ->first();

        $edit->region_id          = $data->region_id;
        $edit->sm_id              = $data->project_manager_id;
        $edit->status             = null;
        $edit->company            = '';
        $edit->project_name       = $data->name;
        $edit->project_id         = $this->project_id;

        // if($this->project_name == '1'){
        //     $datamaster->cmi = $this->danastpl;
        // }

        // if($this->project_name == '2'){
        //     $datamaster->h3i = $this->danastpl;
        // }

        // if($this->project_name == '3'){
        //     $datamaster->isat = $this->danastpl;
        // }

        // if($this->project_name == '4'){
        //     $datamaster->stp = $this->danastpl;
        // }

        // if($this->project_name == '5'){
        //     $datamaster->xl = $this->danastpl;
        // }

        

        $edit->danastpl           = $this->danastpl;
        $edit->note            = '';
        $edit->save();

        session()->flash('message-success',"Dana Berhasil direvisi");
        
        return redirect()->route('dana-stpl.index');
    }
}
