<?php

namespace App\Http\Livewire\DutyRosterDophomebase;

use Livewire\Component;

class Index extends Component
{
    public $project_id;
    protected $queryString = ['project_id'];
    
    public function render()
    {
        return view('livewire.duty-roster-dophomebase.index');
    }

    public function mount()
    {
        if(isset($this->project_id)) session()->put('project_id',$this->project_id);
        \LogActivity::add('[web] Duty Roster - Home Base');
    }
}