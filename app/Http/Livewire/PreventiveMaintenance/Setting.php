<?php

namespace App\Http\Livewire\PreventiveMaintenance;

use Livewire\Component;
use App\Models\PreventiveMaintenance;

class Setting extends Component
{
    public function render()
    {
        $data = PreventiveMaintenance::with(['region','sub_region'])->groupBy('region_id','sub_region_id','site_type','pm_type')->get();

        return view('livewire.preventive-maintenance.setting')->with(['data'=>$data]);
    }
}
