<?php

namespace App\Http\Livewire\PerformanceKpi;

use Livewire\Component;
use App\Models\EmployeeProject;
use App\Models\ClientProject;
use Illuminate\Support\Arr;

class DashboardPpeCheck extends Component
{
    public $projects=[];
    public function render()
    {
        return view('livewire.performance-kpi.dashboard-ppe-check');
    }

    public function mount()
    {
        \LogActivity::add('[web] Performance KPI Dashboard PPE');
        if(check_access('all-project.index'))
            $client_project_ids = [session()->get('project_id')];
        else
            $client_project_ids = Arr::pluck(EmployeeProject::select('client_project_id')->where(['employee_id'=>\Auth::user()->employee->id])->get()->toArray(),'client_project_id');
        
        $this->projects = ClientProject::where('is_project',1)->whereIn('id',$client_project_ids)->get();
    }
}
