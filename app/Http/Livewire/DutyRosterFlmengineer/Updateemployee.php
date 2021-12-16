<?php

namespace App\Http\Livewire\DutyRosterFlmengineer;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Employee;

class Updateemployee extends Component
{
    use WithPagination;
    public $name, $position;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        $data = Employee::select('employees.*')
                    ->orderBy('employees.id', 'DESC')
                    ->join('employee_projects','employee_projects.employee_id','=','employees.id')
                    ->where('employee_projects.client_project_id',session()->get('project_id'));
        if($this->name) $data = $data->where(function($table){
                                    $table->where('employees.name', 'like', '%' . $this->name . '%')->orWhere('nik', $this->name);
                                });
        if($this->position) $data = $data->where('employees.user_access_id', 'like', '%' . $this->position . '%');
        
        return view('livewire.duty-roster-flmengineer.updateemployee')->with(['data'=>$data->paginate(100)]);
    }
}