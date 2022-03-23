<?php

namespace App\Http\Livewire\Vehicle;

use Livewire\Component;

class Index extends Component
{
    public $project_id;
    protected $queryString = ['project_id'];
    public function render()
    {
        return view('livewire.vehicle.index');
    }

    public function mount()
    {
        \LogActivity::add('[web] Vehicle');

        if(isset($this->project_id)) session()->put('project_id',$this->project_id);
    }
}
