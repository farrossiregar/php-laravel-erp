<?php

namespace App\Http\Livewire\MobileApps;

use Livewire\Component;
use App\Models\HealthCheck as HealthCheckModel;

class HealthCheck extends Component
{
    public function render()
    {
        $data = HealthCheckModel::orderBy('id','DESC');

        return view('livewire.mobile-apps.health-check')->with(['data'=>$data->paginate(100)]);
    }
}
