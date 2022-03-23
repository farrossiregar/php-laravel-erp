<?php

namespace App\Http\Livewire\Region;

use Livewire\Component;

class Edit extends Component
{
    public $region_id,$region,$region_code,$data;
    protected $listeners = ['emit-edit' => 'emitEdit'];
    public function render()
    {
        return view('livewire.region.edit');
    }
    public function emitEdit($id)
    {
        $this->data = \App\Models\Region::find($id);
        $this->region_id = $id;
        $this->region = $this->data->region;
        $this->region_code = $this->data->region_code;
    }
    public function save()
    {
        $this->validate([
            'region_code' => 'required',
            'region' => 'required'
        ]);

        $this->data->region_code = $this->region_code;
        $this->data->region = $this->region;
        $this->data->save();
        $this->emit('emit-edit-hide');
        $this->reset();
    }
}