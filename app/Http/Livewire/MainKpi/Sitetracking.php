<?php

namespace App\Http\Livewire\MainKpi;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SiteListTrackingMaster;
use App\Models\SiteListTrackingDetail;
use App\Models\SiteListTrackingTemp;
use App\Models\ClientProject;
use DB;

class Sitetracking extends Component
{
    public $year;
    public $month;
    public $labels;
    public $datasets,$project_name;
    public function render()
    {
        $this->generate_chart();
        return view('livewire.main-kpi.sitetracking');
    }
    
    public function mount()
    {
        $this->year = date('Y');
        $this->client_project_id = session()->get('project_id');
        $this->project_name = ClientProject::find($this->client_project_id)?ClientProject::find($this->client_project_id)->name : '-';
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

        if(empty($this->year)) $this->year = date('Y');
        
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
        })->groupBy('region1')->get() as $k => $item){
            if(SiteListTrackingMaster::where(['id'=>$item->id_site_master,'status'=>1])->get()->count() > 0){ // data harus di approve baru muncul di dashboard
                $this->datasets[$k]['label'] = $item->region1;
                $this->datasets[$k]['backgroundColor']= @$color[$k];
                $this->datasets[$k]['fill'] = 'boundary';
                $this->datasets[$k]['data'] = [];
                foreach(SiteListTrackingDetail::select(\DB::raw("MONTH(period) as month"),'region1')->where('region1',$item->region1)->where(function($table){
                    if($this->year) $table->whereYear('period',$this->year); 
                    if($this->month) $table->whereIn(\DB::raw('MONTH(period)'),$this->month);
                })->groupBy('month')->get() as $k_data => $data){
                    $this->datasets[$k]['data'][] = SiteListTrackingDetail::where(function($table){
                        if($this->year) $table->whereYear('period',$this->year); 
                    })->whereMonth('period',$data->month)->where('region1',$data->region1)->sum('actual_qty');
                }
            }
        }

        $this->labels = json_encode($this->labels);
        $this->datasets = json_encode($this->datasets);
        $this->emit('init-chart-critical-case',['labels'=>$this->labels,'datasets'=>$this->datasets]);
    }


}
