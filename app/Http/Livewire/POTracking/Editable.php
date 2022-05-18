<?php

namespace App\Http\Livewire\POTracking;

use Livewire\Component;
use App\Models\PoTrackingReimbursement;

class Editable extends Component
{
    public $field,$value,$selected;

    public function render()
    {
        return view('livewire.po-tracking.editable');
    }

    public function mount($data,$field)
    {
        $this->selected = $data;
        $this->value = $data->$field;
    }

    public function save()
    {
        $boq = PoTrackingReimbursement::find($this->selected->id);
        $field = $this->field;
        $boq->$field = $this->value;
        $boq->save();

        $this->emit('message-success','data submitted successfully');
    }
}