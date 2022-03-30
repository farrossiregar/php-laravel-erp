<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use App\Models\PoTrackingNonmsBoq;

class Editable extends Component
{
    public $field,$value,$selected;
    public function render()
    {
        return view('livewire.po-tracking-nonms.editable');
    }

    public function mount($data,$field)
    {
        $this->selected = $data;
        $this->value = $data->$field;
    }

    public function save()
    {
        $boq = PoTrackingNonmsBoq::find($this->selected->id);
        $field = $this->field;
        $boq->$field = $this->value;
        $boq->save();

        $this->emit('message-success','data submitted successfully');
    }
}
