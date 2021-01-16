<?php

namespace App\Http\Livewire\Department;

use Livewire\Component;

class Edit extends Component
{
    public $department_id,$data,$name;
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
        $this->data->name = $this->name;
        $this->data->save();
        $this->emit('emitEditHide');
        $this->reset();
        // session()->flash('message-success',__('Data saved successfully'));
        // return redirect()->to('department');
    }
}
