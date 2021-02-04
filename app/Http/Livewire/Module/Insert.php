<?php

namespace App\Http\Livewire\Module;

use Livewire\Component;

class Insert extends Component
{
    public $name,$prefix_link,$icon;
    public function render()
    {
        return view('livewire.module.insert');
    }

    public function save(){
        $this->validate([
            'name'=>'required',
            'icon'=>'required'
        ]);
        
        $data = new \App\Models\Module();
        $data->name = $this->name;
        $data->prefix_link = $this->prefix_link;
        $data->icon = $this->icon;
        $data->save();

        session()->flash('message-success',__('Data saved successfully'));

        return redirect()->route('module.edit',['id'=>$data->id]);
    }
}
