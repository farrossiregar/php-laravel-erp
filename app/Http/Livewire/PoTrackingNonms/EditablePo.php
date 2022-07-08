<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;

class EditablePo extends Component
{   
    public $field,$value,$selected;
    public function render()
    {
        return view('livewire.po-tracking-nonms.editable-po');
    }

    public function mount($data,$field)
    {
        $this->selected = $data;
        $this->value = $data->$field;
    }

    public function save()
    {
        $field = $this->field;
        $this->selected->$field = $this->value;
        $this->selected->save();

        $this->emit('message-success','data submitted successfully');
    }
}
