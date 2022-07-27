<?php

namespace App\Http\Livewire\Finance\Subcont;

use Livewire\Component;

class SubcontEditable extends Component
{
    public $field,$is_edit=false,$data,$value;
    public function render()
    {
        return view('livewire.finance.subcont.subcont-editable');
    }

    public function mount($data,$field)
    {
        $this->data = $data;
        $this->field = $field;
        $this->value = $data->$field;
    }

    public function save()
    {
        $field = $this->field;
        $this->data->$field = $this->value;
        $this->data->save();

        $this->is_edit = false;
    }
}