<?php

namespace App\Http\Livewire\Department;

use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $department_id,$data,$name,$icon;
    protected $listeners = ['emit-edit'=>'emitEdit'];
    public function render()
    {
        return view('livewire.department.edit');
    }
    public function emitEdit($id)
    {
        $this->data = \App\Models\Department::find($id);
        $this->name = $this->data->name;
        $this->department_id = $id;
    }
    public function save()
    {
        $this->validate([
            'name' => 'required'
        ]);

        if($this->icon){
            $name = date('Ymdhis') .".".$this->icon->extension();
            $this->icon->storeAs("public/department/{$this->data->id}", $name);
            $this->data->icon = "storage/department/{$this->data->id}/{$name}";
        }

        $this->data->name = $this->name;
        $this->data->save();
        $this->emit('emitEditHide');
        $this->reset();
    }
}
