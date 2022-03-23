<?php

namespace App\Http\Livewire\Region;

use Livewire\Component;

class Insert extends Component
{
    public $region,$region_code;
    public function render()
    {
        return view('livewire.region.insert');
    }
    public function save()
    {
        $this->validate([
            'region_code' => 'required',
            'region' => 'required'
        ]);

        $data = new \App\Models\Region();
        $data->region_code = $this->region_code;
        $data->region = $this->region;
        $data->save();
        $this->emit('emit-insert-hide');
        $this->reset();
    }
}
