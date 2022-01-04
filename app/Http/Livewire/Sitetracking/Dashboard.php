<?php

namespace App\Http\Livewire\Sitetracking;

use Livewire\Component;
use App\Models\SiteListTrackingMaster;
use App\Models\SiteListTrackingDetail;
use App\Models\ClientProject;

class Dashboard extends Component
{
    public $year;
    public $month;
    public $labels,$region_id;
    public $datasets,$project_name,$regions=[],$data,$data_month;
    
    public function render()
    {
        $this->generate_chart();        
        return view('livewire.sitetracking.dashboard');
    }

    public function mount()
    {
        $this->regions = SiteListTrackingDetail::groupBy('region_id')->get();
        $this->project_name = ClientProject::find(session()->get('project_id'))?ClientProject::find(session()->get('project_id'))->name : '-';
    }
    
    public function updated($propertyName)
    {
        if($propertyName=='year') $this->month = '';
        $this->generate_chart();
    }
    
    public function generate_chart()
    {
        $this->labels = [];
        $this->datasets = [];
        
        $data = SiteListTrackingDetail::groupBy('type','region_id');
        if($this->year) $data->whereYear('period',$this->year);
        if($this->region_id) $data->where('region_id',$this->region_id);
        $this->data = $data->get();

        for($bulan=1;$bulan<=12;$bulan++) {
            $this->labels[] = date('F', mktime(0, 0, 0, $bulan, 10));            
        }

        $color = ['#ffb1c1','#4b89d6','#add64b','#80b10a'];
        foreach(SiteListTrackingDetail::where(function($table){
                                                                if($this->year) $table->whereYear('period',$this->year);
                                                                if($this->month) $table->whereIn(\DB::raw('MONTH(period)'),$this->month);
                                                                if($this->region_id) $table->where('region_id',$this->region_id);
                                                            })->groupBy('type')->get() as $k => $item){

            if(SiteListTrackingMaster::where(['id'=>$item->id_site_master,'status'=>1])->get()->count() > 0){ // data harus di approve baru muncul di dashboard
                $this->datasets[$k]['label'] = $item->type;
                $this->datasets[$k]['backgroundColor']= @$color[$k];
                $this->datasets[$k]['fill'] = 'boundary';
                $this->datasets[$k]['data'] = [];

                for($bulan=1;$bulan<=12;$bulan++) {
                    
                    $sum = SiteListTrackingDetail::where(function($table){
                        if($this->year) $table->whereYear('site_list_tracking_detail.period',$this->year); 
                        if($this->region_id) $table->where('site_list_tracking_detail.region_id',$this->region_id);
                    })->whereMonth('period',$bulan)
                    ->leftJoin('site_list_tracking_master','site_list_tracking_master.id','=','site_list_tracking_detail.id_site_master')
                    ->where(['site_list_tracking_detail.type'=>$item->type,'site_list_tracking_master.status'=>1])->sum('qty_po');
                    
                    $this->data_month[$item->region_id][$item->type][$item->month] = $sum ? $sum : 0; 
                    $this->datasets[$k]['data'][] = $sum ? $sum : 0;
                }
            }    
        }
        
        $this->labels = json_encode($this->labels);
        $this->datasets = json_encode($this->datasets);
        $this->emit('init-chart',['labels'=>$this->labels,'datasets'=>$this->datasets]);
    }
}