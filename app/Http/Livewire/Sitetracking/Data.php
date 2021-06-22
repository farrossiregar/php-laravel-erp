<?php

namespace App\Http\Livewire\Sitetracking;

use Livewire\Component;
use App\Models\SiteListTrackingMaster;

class Data extends Component
{
    public function render()
    {
        $data = SiteListTrackingMaster::orderBy('id', 'DESC');

        return view('livewire.sitetracking.data')->with(['data'=>$data->paginate(100)]);
    }
}
