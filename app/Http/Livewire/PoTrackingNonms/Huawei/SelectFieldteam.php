<?php

namespace App\Http\Livewire\PoTrackingNonms\Huawei;

use Livewire\Component;
use App\Models\EmployeeProject;
use Illuminate\Support\Arr;
use App\Models\Employee;
use App\Models\PoTrackingNonmsHuaweiItem;

class SelectFieldteam extends Component
{
    public $coordinators,$field_teams,$data,$field_team_id,$scoope_of_work;
    protected $listeners = ['set_id'=>'set_id'];
    public function render()
    {
        return view('livewire.po-tracking-nonms.huawei.select-fieldteam');
    }
    
    public function mount()
    {
        $client_project_ids = Arr::pluck(EmployeeProject::select('client_project_id')->where(['employee_id'=>\Auth::user()->employee->id])->get()->toArray(),'client_project_id');

        $this->coordinators = get_user_from_access('is-coordinator',$client_project_ids,\Auth::user()->employee->region_id);
        $this->field_teams = Employee::select('employees.*')->join('employee_projects','employee_projects.employee_id','=','employees.id')->whereIn('client_project_id',$client_project_ids)->get();;
    }

    public function set_id(PoTrackingNonmsHuaweiItem $id)
    {
        $this->data = $id;
    }

    public function save()
    {
        $this->validate([
            'scoope_of_work'=>'required',
            'field_team_id'=>'required'
        ]);

        $this->data->status = 7;
        $this->data->field_team_id  = $this->field_team_id;
        $this->data->scoope_of_work = $this->scoope_of_work;
        $this->data->save();

        $this->emit('modal','hide');
        $this->emit('reload-page');
    }
}
