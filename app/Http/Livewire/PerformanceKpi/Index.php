<?php

namespace App\Http\Livewire\PerformanceKpi;

use Livewire\Component;

class Index extends Component
{
    public $view_index='dashboard',$project_id;
    
    protected $queryString = ['project_id'];
    
    public function render()
    {
        return view('livewire.performance-kpi.index');
    }

    public function mount()
    {
        session()->put('project_id',$this->project_id);
    }
}
