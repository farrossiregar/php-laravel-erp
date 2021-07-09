<?php

namespace App\Http\Livewire\MobileApps;

use Livewire\Component;
use App\Models\VehicleCheck as VehicleCheckModel;

class VehicleCheck extends Component
{
    public $employee_id;

    public function render()
    {
        $data = VehicleCheckModel::orderBy('id','DESC');
        
        if($this->employee_id) $data->where('employee_id',$this->employee_id);

        return view('livewire.mobile-apps.vehicle-check')->with(['data'=>$data->paginate(100)]);
    }
}
