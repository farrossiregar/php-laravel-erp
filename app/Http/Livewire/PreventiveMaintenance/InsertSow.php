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
        $data = PreventiveMaintenanceSow::where(['region_id'=>$this->data->region_id,'sub_region_id'=>$this->data->sub_region_id,'site_type'=>$this->data->site_type,'pm_type'=>$this->data->pm_type])->first();
        if(!$data) $data = new PreventiveMaintenanceSow();
        $data->region_id = $this->data->region_id;
        $data->sub_region_id = $this->data->sub_region_id;
        $data->pm_type = $this->data->pm_type;
        $data->site_type = $this->data->site_type;
        $data->sow = $this->sow;
        $data->save();
    }
}
