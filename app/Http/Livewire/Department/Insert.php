<?php

namespace App\Http\Livewire\Department;

use Livewire\Component;

class Insert extends Component
{
    public $name,$icon;
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
        
        if($this->icon){
            $name = date('Ymdhis') .".".$this->icon->extension();
            $this->icon->storeAs("public/module/{$data->id}", $name);
            $data->icon = "storage/module/{$data->id}/{$name}";
        }
        
        $data->save();

        session()->flash('message-success',__('Data saved successfully'));
        return redirect()->to('department');
    }
}
