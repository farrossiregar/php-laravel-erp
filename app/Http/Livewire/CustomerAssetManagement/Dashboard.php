<?php

namespace App\Http\Livewire\CustomerAssetManagement;

use Livewire\Component;
use App\Models\CustomerAssetManagementHistory;
use App\Models\CustomerAssetManagement;

class Dashboard extends Component
{
    public $year,$datasets,$labels,$month,$region,$datasets_stolen,$labels_stolen=[],$labels_pie,$datasets_pie,$region_cluster_id;
    public function render()
    {
        $this->generate_chart();
        $this->generate_chart_stolen();
        return view('livewire.customer-asset-management.dashboard');
    }

    public function mount()
    {
        $this->year = date('Y');
    }

    public function updated()
    {
        $this->generate_chart();
        $this->generate_chart_stolen();
    }
    public function generate_chart()
    {
        $this->datasets = []; $this->labels = ['NO','NY SUBMIT DATA','YES'];
        foreach(CustomerAssetManagement::groupBy('region_name')->where(function($table){
            if($this->region) $table->whereIn('region_name',$this->region);
        })->get() as $k => $item){
            $this->datasets[$k]['label'] = $item->region_name;
            $this->datasets[$k]['borderColor'] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            $this->datasets[$k]['fill'] =  'boundary';
            $this->datasets[$k]['data'][0] = CustomerAssetManagement::where(['region_name'=>$item->region_name,'apakah_di_site_ini_ada_battery'=>0])->where(function($table){
                                                    if($this->month) $table->whereMonth('tanggal_submission',$this->month);
                                                })->whereNotNull('tanggal_submission')->count();
            $this->datasets[$k]['data'][1] = CustomerAssetManagement::where(['region_name'=>$item->region_name,'apakah_di_site_ini_ada_battery'=>""])->where(function($table){
                if($this->month) $table->whereMonth('tanggal_submission',$this->month);
            })->whereNotNull('tanggal_submission')->count();
            $this->datasets[$k]['data'][2] = CustomerAssetManagement::where(['region_name'=>$item->region_name,'apakah_di_site_ini_ada_battery'=>1])->where(function($table){
                if($this->month) $table->whereMonth('tanggal_submission',$this->month);
            })->whereNotNull('tanggal_submission')->count();
        }

        $this->datasets = json_encode($this->datasets);
        $this->labels = json_encode($this->labels);
        $this->emit('init-chart',['labels'=>$this->labels,'datasets'=>$this->datasets]);
    }

    public function generate_chart_stolen()
    {
        $this->datasets_stolen = [];  $this->labels_stolen = [];
        $this->datasets_pie = []; $this->labels_pie=['STOLEN','NOT STOLEN'];
        
        foreach(CustomerAssetManagementHistory::select("*",\DB::raw('month(created_at) as bulan'))->whereYear('created_at',$this->year)->groupBy('bulan')->where(function($table){
            if($this->region) $table->whereIn('region_name',$this->region);
            if($this->month) $table->whereIn(\DB::raw('month(created_at)'),$this->month);
            // if($this->region_cluster_id) $table->where('region_cluster_id',$this->region_cluster_id);
        })->get() as $k => $item){
            $this->labels_stolen[] = date('F', mktime(0, 0, 0, $item->bulan, 10));;
        }

        $key = 0; 
        $color = ['#ffb1c1','#4b89d6','#add64b','#80b10a'];
        foreach([1=>'STOLEN',2=>'NOT STOLEN'] as $status => $label){
            $this->datasets_stolen[$key]['label'] = $label;
            $this->datasets_stolen[$key]['backgroundColor'] = $color[$key];
            $this->datasets_stolen[$key]['fill'] =  'boundary';

            foreach(CustomerAssetManagementHistory::select("*",\DB::raw('month(created_at) as bulan'))->whereYear('created_at',$this->year)->where(function($table){
                if($this->region) $table->whereIn('region_name',$this->region);
                if($this->month) $table->whereIn(\DB::raw('month(created_at)'),$this->month);
                // if($this->region_cluster_id) $table->where('region_cluster_id',$this->region_cluster_id);
            })->groupBy('bulan')->get() as $k => $item){
                
                $this->datasets_stolen[$key]['data'][] = CustomerAssetManagementHistory::where(['status'=>$status])->whereMonth('created_at',$item->bulan)->whereYear('created_at',$this->year)->where(function($table){
                    if($this->region) $table->whereIn('region_name',$this->region);
                    if($this->region_cluster_id) $table->where('region_cluster_id',$this->region_cluster_id);
                })->count();
            }

            $key++;
        }

        // pie chart
        $this->datasets_pie[0]['label'] = "STOLEN & NOT STOLEN";
        $this->datasets_pie[0]['backgroundColor'] = [$color[0],$color[1]];
        // $this->datasets_stolen[$key]['fill'] =  'boundary';
        $this->datasets_pie[0]['data'] = [];
        foreach([1=>'STOLEN',2=>'NOT STOLEN'] as $status => $label){
            $this->datasets_pie[0]['data'][] = CustomerAssetManagementHistory::select("*",\DB::raw('month(created_at) as bulan'))->where('status',$status)->whereYear('created_at',$this->year)->where(function($table){
                if($this->region) $table->whereIn('region_name',$this->region);
                if($this->month) $table->whereIn(\DB::raw('month(created_at)'),$this->month);
                if($this->region_cluster_id) $table->where('region_cluster_id',$this->region_cluster_id);
            })->count();
        }

        $this->datasets_stolen = json_encode($this->datasets_stolen);
        $this->labels_stolen = json_encode($this->labels_stolen);

        $this->datasets_pie = json_encode($this->datasets_pie);
        $this->labels_pie = json_encode($this->labels_pie);

        $this->emit('init-chart-stolen',['labels_stolen'=>$this->labels_stolen,'datasets_stolen'=>$this->datasets_stolen,'datasets_pie'=>$this->datasets_pie,'labels_pie'=>$this->labels_pie]);
    }
}