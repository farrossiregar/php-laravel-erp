<?php

namespace App\Http\Livewire\DutyRosterFlmengineer;

use Livewire\Component;

class Index extends Component
{
    public $project_id;
    protected $queryString = ['project_id'];

    public function render()
    {
        return view('livewire.duty-roster-flmengineer.index');
    }

    public function mount()
    {
        \LogActivity::add('[web] FLM Engineer');
        
        if(isset($this->project_id)) session()->put('project_id',$this->project_id);
    }
}