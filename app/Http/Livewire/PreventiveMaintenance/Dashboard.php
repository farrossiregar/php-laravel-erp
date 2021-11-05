<?php

namespace App\Http\Livewire\PreventiveMaintenance;

use Livewire\Component;
use App\Models\PreventiveMaintenance;

class Dashboard extends Component
{
    public function render()
    {
        $data = PreventiveMaintenance::select("pm2.*",
                                \DB::raw("(SELECT count(*) FROM preventive_maintenance pm where pm.site_type=pm2.site_type and pm.pm_type=pm2.pm_type and pm.region_id=pm2.region_id and pm.sub_region_id=pm2.sub_region_id and MONTH(pm.created_at)=MONTH(CURRENT_DATE()) and YEAR(pm.created_at)=YEAR(CURRENT_DATE())) as sow"),
                                \DB::raw("(SELECT count(*) FROM preventive_maintenance pm where pm.site_type=pm2.site_type and pm.pm_type=pm2.pm_type and pm.region_id=pm2.region_id and pm.sub_region_id=pm2.sub_region_id and MONTH(pm.created_at)=MONTH(CURRENT_DATE()) and YEAR(pm.created_at)=YEAR(CURRENT_DATE()) and pm.status=2) as total_submitted"),
                                \DB::raw("(SELECT count(*) FROM preventive_maintenance pm where pm.site_type=pm2.site_type and pm.pm_type=pm2.pm_type and pm.region_id=pm2.region_id and pm.sub_region_id=pm2.sub_region_id and DATE(pm.created_at)=DATE(CURRENT_DATE())) as daily"),
                                \DB::raw("(SELECT count(*) FROM preventive_maintenance pm where pm.site_type=pm2.site_type and pm.pm_type=pm2.pm_type and pm.region_id=pm2.region_id and pm.sub_region_id=pm2.sub_region_id and DATE(pm.created_at)=DATE(CURRENT_DATE()) and pm.status=0) as open"),
                                \DB::raw("(SELECT count(*) FROM preventive_maintenance pm where pm.site_type=pm2.site_type and pm.pm_type=pm2.pm_type and pm.region_id=pm2.region_id and pm.sub_region_id=pm2.sub_region_id and DATE(pm.created_at)=DATE(CURRENT_DATE()) and pm.status=1) as in_progress"),
                                \DB::raw("(SELECT count(*) FROM preventive_maintenance pm where pm.site_type=pm2.site_type and pm.pm_type=pm2.pm_type and pm.region_id=pm2.region_id and pm.sub_region_id=pm2.sub_region_id and DATE(pm.created_at)=DATE(CURRENT_DATE()) and pm.status=2) as submitted")
                            )
                                ->from('preventive_maintenance','pm2')
                            ->with(['region','sub_region'])->groupBy('region_id','sub_region_id','site_type','pm_type');

        if(!check_access('preventive-maintenance.show-all-region')) $data->where('admin_project_id',\Auth::user()->employee->id);

        return view('livewire.preventive-maintenance.dashboard')->with(['data'=>$data->get()]);
    }
}
