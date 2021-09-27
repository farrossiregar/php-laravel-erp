<?php

namespace App\Http\Livewire\PerformanceKpi;

use Livewire\Component;

class Dashboard extends Component
{
    public $dashboard_view = 'commitment_daily';
    public function render()
    {
        return view('livewire.performance-kpi.dashboard');
    }
}