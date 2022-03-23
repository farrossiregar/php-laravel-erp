<?php

namespace App\Http\Livewire\Department;

use Livewire\Component;

class InsertSubDepartment extends Component
{
    public $department_id,$department,$name;
    protected $listeners = ['emit-insert-sub'=>'emitInsertSub'];
    public function render()
    {
        return view('livewire.department.insert-sub-department');
    }
    public function emitInsertSub($id)
    {
        $this->department_id = $id;
        $department = \App\Models\Department::find($id);
        if($department) $this->department = $department->name;
    }
    public function save()
    {
        $this->validate(
            [
                'name' => 'required'
            ]);
        $data = new \App\Models\DepartmentSub();
        $data->department_id = $this->department_id;
        $data->name = $this->name;
        $data->save();
        session()->flash('message-success',__('Data saved successfully'));
        return redirect()->to('department');
    }
}
