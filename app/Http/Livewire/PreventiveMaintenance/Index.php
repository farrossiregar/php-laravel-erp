<?php

namespace App\Http\Livewire\PreventiveMaintenance;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        \LogActivity::add('Preventive Maintenance');

        return view('livewire.preventive-maintenance.index');
    }
}
