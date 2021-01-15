<?php

namespace App\Http\Livewire\Department;

use Livewire\Component;

class Insert extends Component
{
    public $name;
    public function render()
    {
        return view('livewire.department.insert');
    }
    public function save()
    {
        $this->validate([
            'name'=>'required'
        ]);
        $data = new \App\Models\Department();
        $data->name = $this->name;
        $data->save();
        session()->flash('message-success',__('Data saved successfully'));
        return redirect()->to('department');
    }
}
