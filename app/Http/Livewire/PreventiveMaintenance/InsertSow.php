<?php

namespace App\Http\Livewire\PreventiveMaintenance;

use App\Models\PreventiveMaintenanceSow;
use Livewire\Component;

class InsertSow extends Component
{
    public $data,$sow;
    
    public function render()
    {
        return view('livewire.preventive-maintenance.insert-sow');
    }

    public function mount($item)
    {
        $this->data = $item;
    }

    public function save()
    {
        $data = new PreventiveMaintenanceSow();
        $data->region_id = $this->data->region_id;
        $data->sub_region_id = $this->data->sub_region_id;
        $data->sow = $this->sow;
        $data->save();
    }
}
