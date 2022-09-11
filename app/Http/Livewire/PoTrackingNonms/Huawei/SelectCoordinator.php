<?php

namespace App\Http\Livewire\PoTrackingNonms\Huawei;

use Livewire\Component;
use App\Models\EmployeeProject;
use Illuminate\Support\Arr;
use App\Models\Employee;
use App\Models\PoTrackingNonmsHuawei;

class SelectCoordinator extends Component
{
    public $coordinators,$field_teams,$data,$coordinator_id;
    protected $listeners = ['set_id'=>'set_id'];
    public function render()
    {
        return view('livewire.po-tracking-nonms.huawei.select-coordinator');
    }
    
    public function mount()
    {
        $client_project_ids = Arr::pluck(EmployeeProject::select('client_project_id')->where(['employee_id'=>\Auth::user()->employee->id])->get()->toArray(),'client_project_id');

        $this->coordinators = get_user_from_access('is-coordinator',$client_project_ids,\Auth::user()->employee->region_id);
        $this->field_teams = Employee::select('employees.*')->join('employee_projects','employee_projects.employee_id','=','employees.id')->whereIn('client_project_id',$client_project_ids)->get();;
    }

    public function set_id(PoTrackingNonmsHuawei $id)
    {
        $this->data = $id;
    }

    public function save()
    {
        $this->validate([
            'coordinator_id'=>'required'
        ]);

        $this->data->status = 6;
        $this->data->coordinator_id  = $this->coordinator_id;
        $this->data->save();

        $this->emit('modal','hide');
        $this->emit('reload-page');
    }
}
