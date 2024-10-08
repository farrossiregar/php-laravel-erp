<?php

namespace App\Http\Livewire\TeamSchedule;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        if(!check_access('team-schedule.index')){
            session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
            $this->redirect('/');
        }
        return view('livewire.team-schedule.index');
    }
}
