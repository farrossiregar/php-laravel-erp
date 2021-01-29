<?php

namespace App\Http\Livewire\WorkFlowManagement;

use Livewire\Component;

class WfmInternalReview extends Component
{
    public $region,$month,$data,$date;
    public function render()
    {
        return view('livewire.work-flow-management.wfm-internal-review');
    }
    public function mount()
    {
        $this->data = \App\Models\WorkFlowManagement::groupBy('servicearea2','name')->get();
        $this->date = \App\Models\WorkFlowManagement::groupBy('date')->get();
    }
}
