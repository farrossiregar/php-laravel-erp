<?php

namespace App\Http\Livewire\Locationoffieldteam;

use Livewire\Component;
use App\Models\LocationOfFieldTeam as modelLocation;

class Index extends Component
{
    public function render()
    {
        $data = modelLocation::orderBy('id','desc');

        return view('livewire.locationoffieldteam.index')->with(['data'=>$data->paginate(100)]);
    }
}
