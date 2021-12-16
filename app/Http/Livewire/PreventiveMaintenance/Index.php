<?php

namespace App\Http\Livewire\PreventiveMaintenance;

use Livewire\Component;

class Index extends Component
{
    public $project_id;

    protected $queryString = ['project_id'];

    public function render()
    {
        \LogActivity::add('[web] Preventive Maintenance');

        return view('livewire.preventive-maintenance.index');
    }

    public function mount()
    {
        if(isset($this->project_id)) session()->put('project_id',$this->project_id);
    }
}
