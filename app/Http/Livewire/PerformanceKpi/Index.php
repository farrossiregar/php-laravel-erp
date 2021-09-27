<?php

namespace App\Http\Livewire\PerformanceKpi;

use Livewire\Component;

class Index extends Component
{
    public $view_index='dashboard';
    public function render()
    {
        return view('livewire.performance-kpi.index');
    }
}
