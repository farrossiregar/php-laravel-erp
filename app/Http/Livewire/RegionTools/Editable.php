<?php

namespace App\Http\Livewire\RegionTools;

use Livewire\Component;
use App\Models\RegionTools;

class Editable extends Component
{
    public $data,$field,$value;
    public function render()
    {
        return view('livewire.region-tools.editable');
    }

    public function mount($data,$field)
    {
        $this->data = $data;
        $this->field = $field;
        $this->value = $this->data->$field;
    }

    public function save()
    {
        $field = $this->field;
        $this->data->$field = $this->value;
        $this->data->save();
    }
}
