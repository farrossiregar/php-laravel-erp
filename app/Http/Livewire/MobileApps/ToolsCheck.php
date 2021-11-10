<?php

namespace App\Http\Livewire\MobileApps;

use Livewire\Component;
use App\Models\ToolsCheck as ToolsCheckModel;
use App\Models\Toolbox;
use Illuminate\Support\Arr;
use App\Models\EmployeeProject;
use App\Models\Region;
use App\Models\SubRegion;
use Livewire\WithPagination;

class ToolsCheck extends Component
{
    public $employee_id,$tahun,$bulan,$toolboxs,$region=[],$sub_region=[],$region_id,$sub_region_id,$user_access_id;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        $data = ToolsCheckModel::select('tools_check.*','employees.name')
                            ->with('_employee')
                            ->orderBy('tools_check.updated_at','DESC')
                            ->join('employees','employees.id','=','employee_id');
        
        if($this->tahun) $data->where('tahun',$this->tahun);
        if($this->bulan) $data->where('bulan',$this->bulan);
        if($this->region_id) {
            $data->where('tools_check.region_id',$this->region_id);
            $this->sub_region = SubRegion::where('region_id',$this->region_id)->get();
        }
        if($this->sub_region_id) $data->where('tools_check.sub_region_id',$this->sub_region_id);
        if($this->user_access_id) $data->where('employees.user_access_id',$this->user_access_id);

        if(check_access('all-project.index'))
            $client_project_ids = [session()->get('project_id')];
        else
            $client_project_ids = Arr::pluck(EmployeeProject::select('client_project_id')->where(['employee_id'=>\Auth::user()->employee->id])->get()->toArray(),'client_project_id');
        
        $data->whereIn('tools_check.client_project_id',$client_project_ids);
        
        return view('livewire.mobile-apps.tools-check')->with(['data'=>$data->paginate(100)]);
    }

    public function mount()
    {
        $this->toolboxs = Toolbox::orderBy('name')->get();
        $this->region  = Region::select(['id','region'])->get();
    }
}