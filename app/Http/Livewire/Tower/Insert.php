<?php

namespace App\Http\Livewire\Tower;

use Livewire\Component;

class Insert extends Component
{
    public $name,$site_id;
    public function render()
    {
        return view('livewire.tower.insert');
    }
    public function save()
    {
        $this->validate([
            'name' => 'required',
            'site_id' => 'required'
        ]);

        $data = new \App\Models\Tower();
        $data->name = $this->name;
        $data->site_id = $this->site_id;
        $data->save();
            
        $this->emit('refresh-page');
    }
}
