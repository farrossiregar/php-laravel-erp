<?php

namespace App\Http\Livewire\MobileApps;

use App\Models\LocationOfFieldTeam as ModelsLocationOfFieldTeam;
use Livewire\Component;

class LocationOfFieldTeam extends Component
{
    public function render()
    {
        $data = ModelsLocationOfFieldTeam::orderBy('id','desc');

        return view('livewire.mobile-apps.location-of-field-team')->with(['data'=>$data->paginate(100)]);
    }
}
