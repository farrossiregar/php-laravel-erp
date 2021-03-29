<?php

namespace App\Http\Livewire\CustomerAssetManagement;

use Livewire\Component;

class Dashboard extends Component
{
    public $year,$datasets,$labels,$month,$region;
    public function render()
    {
        $this->generate_chart();
        return view('livewire.customer-asset-management.dashboard');
    }
    public function updated()
    {
        $this->generate_chart();
    }
    public function generate_chart()
    {
        $this->datasets = []; $this->labels = ['NO','NY SUBMIT DATA','YES'];
        foreach(\App\Models\CustomerAssetManagement::groupBy('region_name')->where(function($table){
            if($this->region) $table->whereIn('region_name',$this->region);
        })->get() as $k => $item){
            $this->datasets[$k]['label'] = $item->region_name;
            $this->datasets[$k]['borderColor'] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            $this->datasets[$k]['fill'] =  'boundary';
            $this->datasets[$k]['data'][0] = \App\Models\CustomerAssetManagement::where(['region_name'=>$item->region_name,'apakah_di_site_ini_ada_battery'=>0])->where(function($table){
                                                    if($this->month) $table->whereMonth('tanggal_submission',$this->month);
                                                })->whereNotNull('tanggal_submission')->count();
            $this->datasets[$k]['data'][1] = \App\Models\CustomerAssetManagement::where(['region_name'=>$item->region_name,'apakah_di_site_ini_ada_battery'=>""])->where(function($table){
                if($this->month) $table->whereMonth('tanggal_submission',$this->month);
            })->whereNotNull('tanggal_submission')->count();
            $this->datasets[$k]['data'][2] = \App\Models\CustomerAssetManagement::where(['region_name'=>$item->region_name,'apakah_di_site_ini_ada_battery'=>1])->where(function($table){
                if($this->month) $table->whereMonth('tanggal_submission',$this->month);
            })->whereNotNull('tanggal_submission')->count();
        }

        $this->datasets = json_encode($this->datasets);
        $this->labels = json_encode($this->labels);
        $this->emit('init-chart',['labels'=>$this->labels,'datasets'=>$this->datasets]);
    }
}
