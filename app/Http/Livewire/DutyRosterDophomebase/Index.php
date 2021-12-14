<?php

namespace App\Http\Livewire\DutyRosterDophomebase;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.duty-roster-dophomebase.index');
    }

    public function mount()
    {
        \LogActivity::add('[web] Duty Roster - Home Base');
    }
}