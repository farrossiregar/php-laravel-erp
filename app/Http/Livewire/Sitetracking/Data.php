<?php

namespace App\Http\Livewire\Sitetracking;

use Livewire\Component;

class Data extends Component
{
    public function render()
    {
        $data = \App\Models\SiteListTrackingMaster::orderBy('id', 'DESC');

        return view('livewire.sitetracking.data')->with(['data'=>$data->paginate(100)]);
    }
}
