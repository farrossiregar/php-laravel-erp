<?php

namespace App\Http\Livewire\MobileApps;

use Livewire\Component;
use App\Models\PpeCheck as PpeCheckModel;

class PpeCheck extends Component
{
    public function render()
    {
        $data = PpeCheckModel::orderBy('id','DESC');
        
        return view('livewire.mobile-apps.ppe-check')->with(['data'=>$data->paginate(100)]);
    }
}
