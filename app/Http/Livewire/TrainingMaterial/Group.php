<?php

namespace App\Http\Livewire\TrainingMaterial;

use Livewire\Component;
use App\Models\TrainingMaterialGroup;
Use App\Models\TrainingMaterialGroupEmployee;
Use App\Models\Employee;

class Group extends Component
{
    public $insert=false,$group,$employee_id=[],$count_employee_id= [],$employees;
    protected $listeners = ['refresh-page' => '$refresh'];

    public function render()
    {
        $data = TrainingMaterialGroup::orderBy('id','DESC')->get();

        return view('livewire.training-material.group')->with(['data'=>$data]);
    }

    public function mount()
    {
        $this->employees = Employee::where('is_use_android',1)->get();
    }

    public function delete_employee($k)
    {
        unset($this->count_employee_id[$k],$this->employee_id[$k]);
    }

    public function add_employee()
    {
        $this->count_employee_id[] = count($this->count_employee_id);
        $this->employee_id[] = "";
    }

    public function remove_group(TrainingMaterialGroup $data)
    {
        TrainingMaterialGroupEmployee::where('training_material_group_id',$data->id)->delete();
        $data->delete();
    }

    public function remove_employee(TrainingMaterialGroupEmployee $data)
    {
        $data->delete();
    }

    public function store()
    {
        $this->validate([
            'group' => 'required',
            'employee_id' => 'required'
        ]);

        $group = new TrainingMaterialGroup();
        $group->name = $this->group;
        $group->save();

        foreach($this->employee_id as $item){
            $em = new TrainingMaterialGroupEmployee();
            $em->training_material_group_id = $group->id;
            $em->employee_id = $item;
            $em->save();
        }
        $this->reset(['group','employee_id','count_employee_id']);
        $this->emitSelf('refresh-page');
        $this->insert = false;
    }
}
