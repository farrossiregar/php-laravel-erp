<?php

namespace App\Http\Livewire\PreventiveMaintenance;

use App\Models\PreventiveMaintenanceSow;
use App\Models\PreventiveMaintenanceSowMaster;
use Livewire\Component;

class InsertSow extends Component
{
    public $data,$sow,$sow_master;
    
    public function render()
    {
        return view('livewire.preventive-maintenance.insert-sow');
    }

    public function mount(PreventiveMaintenanceSowMaster $data)
    {
        $this->sow_master = $data;
        $this->data = PreventiveMaintenanceSow::where(['region_id'=>$this->sow_master->region_id,
                                                    'sub_region_id'=>$this->sow_master->sub_region_id,
                                                    'site_type'=>$this->sow_master->site_type,
                                                    'pm_type'=>$this->sow_master->pm_type,
                                                    'bulan'=>date('m'),
                                                    'tahun'=>date('Y')])->first();

        $this->sow = $this->data ? $this->data->sow : 0;
    }

    public function save()
    {
        if(!$this->data) {
            \LogActivity::add('[web] PM Insert SOW');
            $this->data = new PreventiveMaintenanceSow();
            $this->data->region_id = $this->sow_master->region_id;
            $this->data->sub_region_id = $this->sow_master->sub_region_id;
            $this->data->pm_type = $this->sow_master->pm_type;
            $this->data->site_type = $this->sow_master->site_type;
            $this->data->bulan = date('m');
            $this->data->tahun = date('Y');
        }else{
            \LogActivity::add('[web] PM Update SOW');
        }

        $this->data->sow = $this->sow;
        $this->data->save();
    }
}