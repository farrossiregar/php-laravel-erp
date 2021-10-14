<?php

namespace App\Http\Livewire\MobileApps;

use Livewire\Component;
use App\Models\ToolsCheck as ToolsCheckModel;
use App\Models\Toolbox;
use Illuminate\Support\Arr;
use App\Models\EmployeeProject;

class ToolsCheck extends Component
{
    public $employee_id,$tahun,$bulan,$toolboxs;

    public function render()
    {
        $data = ToolsCheckModel::select('tools_check.*','employees.name')->orderBy('tools_check.id','DESC')->join('employees','employees.id','=','employee_id');
        
        if($this->tahun) $data->where('tahun',$this->tahun);
        if($this->bulan) $data->where('bulan',$this->bulan);
        if(check_access('all-project.index'))
            $client_project_ids = [session()->get('project_id')];
        else
            $client_project_ids = Arr::pluck(EmployeeProject::select('client_project_id')->where(['employee_id'=>\Auth::user()->employee->id])->get()->toArray(),'client_project_id');
        
        $data->whereIn('tools_check.client_project_id',$client_project_ids);
        
        return view('livewire.mobile-apps.tools-check')->with(['data'=>$data->paginate(100)]);
    }

    public function mount()
    {
        $this->toolboxs = Toolbox::get();
    }
}