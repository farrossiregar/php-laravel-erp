<?php

namespace App\Http\Livewire\Department;

use Livewire\Component;

class EditSubDepartment extends Component
{
    public $department,$department_sub_id,$data,$name,$department_id;
    protected $listeners = ['emit-edit-sub-department'=>'emitEdit'];
    public function render()
    {
        return view('livewire.department.edit-sub-department');
    }
    public function emitEdit($id)
    {
        $this->data = \App\Models\DepartmentSub::find($id);
        $this->name = $this->data->name;
        $this->department = $this->data->department->name;
        $this->department_id = $this->data->department_id;
    }
    public function save()
    {
        $this->data->department_id = $this->department_id;
        $this->data->name = $this->name;
        $this->data->save();
        $this->emit('emitEditSubDepartmentHide');
        $this->reset();
    }
}
