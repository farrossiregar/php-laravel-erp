<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use App\Models\PoTrackingNonms;

class SelectCoordinatorStp extends Component
{
    public $data,$edit=false,$field_team_id;
    protected $listeners = ['refresh-page'=>'$refresh'];

    public function render()
    {
        return view('livewire.po-tracking-nonms.select-coordinator-stp');
    }

    public function mount(PoTrackingNonms $data)
    {
        $this->data = $data;
    }

    public function save()
    {
        $this->data->field_team_id = $this->field_team_id;
        $this->data->save();
        $this->edit = false;

        $this->emit('refresh-page');
    }
}
