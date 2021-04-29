<?php

namespace App\Http\Livewire\MobileApps;

use Livewire\Component;
use App\Models\VehicleCheck as VehicleCheckModel;

class VehicleCheck extends Component
{
    public function render()
    {
        $data = VehicleCheckModel::orderBy('id','DESC');

        return view('livewire.mobile-apps.vehicle-check')->with(['data'=>$data->paginate(100)]);
    }
}
