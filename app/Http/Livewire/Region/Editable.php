<?php

namespace App\Http\Livewire\Region;

use Livewire\Component;

class Editable extends Component
{
    public $data,$field,$insert=false;
    public function render()
    {
        return view('livewire.region.editable');
    }

    public function mounth($data)
    {
        $this->data = $data;
        $this->field = $data->name;
    }
    
    public function set_insert()
    {
        $this->field = $this->data->name;
        $this->insert = true;
    }

    public function save()
    {
        $this->data->name = $this->field;
        $this->data->save();
        $this->insert = false;
        $this->emit('message-success','data saved successfully');
    }
}
