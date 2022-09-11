<?php

namespace App\Http\Livewire\Finance\HqAdministration;

use Livewire\Component;

class HqAdministrationEditable extends Component
{
    public $field,$is_edit=false,$data,$value;
    public function render()
    {
        return view('livewire.finance.hq-administration.hq-administration-editable');
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