<?php

namespace App\Http\Livewire\PerformanceKpi;

use Livewire\Component;
use App\Models\ClientProject;
use App\Models\EmployeeProject;
use Illuminate\Support\Arr;

class DashboardCommitmentDaily extends Component
{
    public $projects=[];

    public function render()
    {
        return view('livewire.performance-kpi.dashboard-commitment-daily');
    }

    public function mount()
    {
        // get client_project 
        $client_project_ids = Arr::pluck(EmployeeProject::select('client_project_id')->where(['employee_id'=>\Auth::user()->employee->id])->get()->toArray(),'client_project_id');
        
        $this->projects = ClientProject::where('is_project',1)->whereIn('id',$client_project_ids)->get();
    }
}