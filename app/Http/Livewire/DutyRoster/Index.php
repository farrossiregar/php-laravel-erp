<?php

namespace App\Http\Livewire\DutyRoster;

use Livewire\Component;

class Index extends Component
{
    public $project_id;
    protected $queryString = ['project_id'];
    
    public function render()
    {
        return view('livewire.duty-roster.index');
    }

    public function mount()
    {
        if(isset($this->project_id)) session()->put('project_id',$this->project_id);
    }
}