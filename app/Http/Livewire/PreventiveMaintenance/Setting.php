<?php

namespace App\Http\Livewire\PreventiveMaintenance;

use Livewire\Component;
//use App\Models\PreventiveMaintenance;
use App\Models\PreventiveMaintenanceSowMaster;

class Setting extends Component
{
    public function render()
    {
        $data = PreventiveMaintenanceSowMaster::with(['region','sub_region'])->get();
        
        return view('livewire.preventive-maintenance.setting')->with(['data'=>$data]);
    }
}