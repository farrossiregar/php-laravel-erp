<?php

namespace App\Http\Livewire\Sitetracking;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SiteListTrackingMaster;
use App\Models\SiteListTrackingDetail;
use App\Models\SiteListTrackingTemp;
use App\Models\ClientProject;
use App\Helpers\GeneralHelper;
use DB;

class Dashboard extends Component
{
    public $year;
    public $month;
    public $labels,$region_id;
    public $datasets,$project_name,$regions=[];
    
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

        foreach(SiteListTrackingDetail::select(\DB::raw("MONTH(period) as month"))->where(function($table){ 
            if($this->year) $table->whereYear('period',$this->year); 
            if($this->month) $table->whereIn(\DB::raw('MONTH(period)'),$this->month);
        })->groupBy('month')->get() as $k => $item){
            $this->labels[] = date('F', mktime(0, 0, 0, $item->month, 10));
        }
        $color = ['#ffb1c1','#4b89d6','#add64b','#80b10a'];
        foreach(SiteListTrackingDetail::where(function($table){
            if($this->year)$table->whereYear('period',$this->year);
            if($this->month) $table->whereIn(\DB::raw('MONTH(period)'),$this->month);
            if($this->region_id) $table->where('region_id',$this->region_id);
        })->groupBy('region1')->get() as $k => $item){

            if(SiteListTrackingMaster::where(['id'=>$item->id_site_master,'status'=>1])->get()->count() > 0){ // data harus di approve baru muncul di dashboard
                $this->datasets[$k]['label'] = $item->region1;
                $this->datasets[$k]['backgroundColor']= @$color[$k];//sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                $this->datasets[$k]['fill'] = 'boundary';
                $this->datasets[$k]['data'] = [];
                foreach(SiteListTrackingDetail::select(\DB::raw("MONTH(period) as month"),'region1')->where('region1',$item->region1)->where(function($table){
                    if($this->year) $table->whereYear('period',$this->year); 
                    if($this->month) $table->whereIn(\DB::raw('MONTH(period)'),$this->month);
                if($this->region_id) $table->where('region_id',$this->region_id);
                })->groupBy('month')->get() as $k_data => $data){
                    $this->datasets[$k]['data'][] = SiteListTrackingDetail::where(function($table){
                        if($this->year) $table->whereYear('period',$this->year); 
                        if($this->region_id) $table->where('region_id',$this->region_id);
                    })->whereMonth('period',$data->month)->where('region1',$data->region1)->sum('actual_qty');
                }
            }
        }

        $this->labels = json_encode($this->labels);
        $this->datasets = json_encode($this->datasets);
        
        $this->emit('init-chart',['labels'=>$this->labels,'datasets'=>$this->datasets]);
    }


}
