<?php

namespace App\Http\Livewire\PerformanceKpi;

use Livewire\Component;
use App\Models\ClientProject;

class Dashboard extends Component
{
    public $projects=[];
    public function render()
    {
        return view('livewire.performance-kpi.dashboard');
    }

    public function mount()
    {
        $this->projects = ClientProject::where('is_project',1)->get();
    }
}
