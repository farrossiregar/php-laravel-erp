<?php

namespace App\Http\Livewire\PreventiveMaintenance;

use App\Models\ClientProjectRegion;
use Livewire\Component;
use App\Models\PreventiveMaintenance;
use App\Models\PreventiveMaintenanceSow;
use stdClass;

class Dashboard extends Component
{
    public $date_start,$date_end,$labels,$series,$total_submitted,$total_approved_eid,$total_pm,$total_sow=0;
    public $sub_region_id,$client_project_id,$sub_region=[];
    public $background = ['#9ad0f5','#ffb1c1','#8fe045'];
    public function render()
    {
        $data = $this->init_data();

        return view('livewire.preventive-maintenance.dashboard')->with(['data'=>$data->get()]);
    }

    public function init_data()
    {
        $data = PreventiveMaintenance::select("pm2.*",
                                \DB::raw("(SELECT count(*) FROM preventive_maintenance pm where pm.site_type=pm2.site_type and pm.pm_type=pm2.pm_type and pm.region_id=pm2.region_id and pm.sub_region_id=pm2.sub_region_id and MONTH(pm.created_at)=MONTH(CURRENT_DATE()) and YEAR(pm.created_at)=YEAR(CURRENT_DATE())) as sow"),
                                \DB::raw("(SELECT count(*) FROM preventive_maintenance pm where pm.site_type=pm2.site_type and pm.pm_type=pm2.pm_type and pm.region_id=pm2.region_id and pm.sub_region_id=pm2.sub_region_id and MONTH(pm.created_at)=MONTH(CURRENT_DATE()) and YEAR(pm.created_at)=YEAR(CURRENT_DATE()) and pm.status=2) as total_submitted"),
                                \DB::raw("(SELECT count(*) FROM preventive_maintenance pm where pm.site_type=pm2.site_type and pm.pm_type=pm2.pm_type and pm.region_id=pm2.region_id and pm.sub_region_id=pm2.sub_region_id and DATE(pm.created_at)=DATE(CURRENT_DATE())) as daily"),
                                \DB::raw("(SELECT count(*) FROM preventive_maintenance pm where pm.site_type=pm2.site_type and pm.pm_type=pm2.pm_type and pm.region_id=pm2.region_id and pm.sub_region_id=pm2.sub_region_id and MONTH(pm.created_at)=MONTH(CURRENT_DATE()) and pm.status=0) as open"),
                                \DB::raw("(SELECT count(*) FROM preventive_maintenance pm where pm.site_type=pm2.site_type and pm.pm_type=pm2.pm_type and pm.region_id=pm2.region_id and pm.sub_region_id=pm2.sub_region_id and MONTH(pm.created_at)=MONTH(CURRENT_DATE()) and pm.status=1) as in_progress"),
                                \DB::raw("(SELECT count(*) FROM preventive_maintenance pm where pm.site_type=pm2.site_type and pm.pm_type=pm2.pm_type and pm.region_id=pm2.region_id and pm.sub_region_id=pm2.sub_region_id and MONTH(pm.created_at)=MONTH(CURRENT_DATE()) and pm.status=2) as submitted"),
                                \DB::raw("(SELECT count(*) FROM preventive_maintenance pm where pm.site_type=pm2.site_type and pm.pm_type=pm2.pm_type and pm.region_id=pm2.region_id and pm.sub_region_id=pm2.sub_region_id and MONTH(pm.created_at)=MONTH(CURRENT_DATE()) and pm.status=2 and is_upload_report=1) as approved_ied")
                            )
                            ->from('preventive_maintenance','pm2')
                            ->with(['region','sub_region'])->groupBy('region_id','sub_region_id','site_type','pm_type');
        if($this->date_start and $this->date_end){
            if($this->date_start == $this->date_end)
                $data->whereDate('pm2.created_at',$this->date_start);
            else
                $data->whereBetween('pm2.created_at',[$this->date_start,$this->date_end]);
        }

        if(!check_access('preventive-maintenance.show-all-region')) $data->where('admin_project_id',\Auth::user()->employee->id);
        $this->sub_region = ClientProjectRegion::select('sub_region.*')
                                                ->where('client_project_id',$this->client_project_id)
                                                ->join('sub_region','sub_region.region_id','client_project_region.region_id')
                                                ->groupBy('sub_region.id')
                                                ->get();
        return $data;
    }

    public function updated($propertyName)
    {
        $this->chart();
    }

    public function mount()
    {
        $this->client_project_id = session()->get('project_id');
        $this->total_sow =PreventiveMaintenanceSow::sum('sow'); 
        $this->total_pm = PreventiveMaintenance::whereMonth('created_at',date('m'))->whereYear('created_at',date('Y'))->count();
        $this->total_submitted = PreventiveMaintenance::where('status',2)->whereMonth('created_at',date('m'))->whereYear('created_at',date('Y'))->count();
        $this->total_approved_eid = PreventiveMaintenance::where(['status'=>2,'is_upload_report'=>1])->whereMonth('created_at',date('m'))->whereYear('created_at',date('Y'))->count();
        $this->chart();
    }

    public function chart()
    {
        $this->labels = [];$this->series=[];
        $data = PreventiveMaintenance::with(['region','sub_region'])
                                        ->groupBy('region_id','sub_region_id')
                                        ->where(function($table){
                                            if($this->sub_region_id) $table->where('sub_region_id',$this->sub_region_id);
                                        })
                                        ->get();
        
        if($this->date_start and $this->date_end){
            if($this->date_start == $this->date_end)
                $data->whereDate('created_at',$this->date_start);
            else
                $data->whereBetween('created_at',[$this->date_start,$this->date_end]);
        }
        if(!check_access('preventive-maintenance.show-all-region')) $data->where('admin_project_id',\Auth::user()->employee->id);

        $data_series = new stdClass;
        foreach($data as $k => $item){
            if(isset($item->region->region_code)){
                $this->labels[] = isset($item->sub_region->name) ? $item->region->region_code . " - ". $item->sub_region->name : "";
                $data_series->$k = $item;
            }
        }

        foreach(['SOW (Monthly Target)','Submitted','Approved EID'] as $k=>$item){
            $this->series[$k]['label'] = $item;
            $this->series[$k]['borderColor'] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            $this->series[$k]['fill'] =  'boundary';
            $this->series[$k]['backgroundColor'] = $this->background[$k];
            $this->series[$k]['data'] = [];
            foreach($data_series as $region){
                if($k==0){
                    $sum = PreventiveMaintenanceSow::where(['region_id'=>$region->region_id,'sub_region_id'=>$region->sub_region_id])->where(function($table){
                        // if($this->date_start and $this->date_end){
                        //     if($this->date_start == $this->date_end)
                        //         $table->whereDate('created_at',$this->date_start);
                        //     else
                        //         $table->whereBetween('created_at',[$this->date_start,$this->date_end]);
                        // }
                        if($this->sub_region_id) $table->where('sub_region_id',$this->sub_region_id);
                    })->sum('sow');
                    $this->series[$k]['data'][] = (int)$sum;
                }else{
                    $count = PreventiveMaintenance::where(['region_id'=>$region->region_id,'sub_region_id'=>$region->sub_region_id])->where(function($table){
                        if($this->date_start and $this->date_end){
                            if($this->date_start == $this->date_end)
                                $table->whereDate('created_at',$this->date_start);
                            else
                                $table->whereBetween('created_at',[$this->date_start,$this->date_end]);
                        }
                        if($this->sub_region_id) $table->where('sub_region_id',$this->sub_region_id);
                    });
                    
                    if($k==1) $count = $count->where('status',2);
                    if($k==2) $count = $count->where(['status'=>2,'is_upload_report'=>1]);

                    $this->series[$k]['data'][] = (int)$count->count();
                }
            }
        }   

        $this->labels = json_encode($this->labels);
        $this->series = json_encode($this->series);

        $this->emit('init-chart',['labels'=>$this->labels,'series'=>$this->series]);
    }
}
