<?php

namespace App\Http\Livewire\WorkFlowManagement;

use Livewire\Component;

class TotalFtNeverCloseManual extends Component
{
    public $year,$month,$labels,$series,$legendNames;
    protected $listeners = [
        'refresh-page'=>'$refresh',
        'emit-year' => 'filterYear',
        'emit-month' => 'filterMonth',
        'emit-region' => 'filterRegion',
        'init-chart-total-ft-never-close-manual'=>'generate_chart'];
    public function render()
    {
        return view('livewire.work-flow-management.total-ft-never-close-manual');
    }
    public function mount()
    {
        $this->year = date('Y');
    }
    public function filterYear($year)
    {
        $this->year = $year;
        $this->month = '';
        $this->generate_chart();
    }
    public function filterMonth($month)
    {
        $this->month = $month;
        $this->generate_chart();
    }
    public function filterRegion($region){
        $this->region = $region;
        $this->generate_chart();
    }
    public function updated($componentName){
        if($componentName=='year') $this->month = '';
        $this->generate_chart();
    }
    public function generate_chart()
    {
        $this->labels = [];$this->series=[];
        if($this->month) foreach($this->month as $k => $m) if($m!=false) $this->month[$k] = $m; else unset($this->month[$k]);
        foreach(\App\Models\WorkFlowManagement::where(function($table){
                        $table->whereYear('date',$this->year);
                        if($this->month) $table->whereIn(\DB::raw('MONTH(date)'),$this->month);
                    })->groupBy('date')->get() as $item){
            $this->labels[] = date('d/m/y',strtotime($item->date));   
        }
        foreach(\App\Models\WorkFlowManagement::where(function($table){
            $table->whereYear('date',$this->year);
            if($this->month) $table->whereIn(\DB::raw('MONTH(date)'),$this->month);
        })->groupBy('region_dan_asp_info','skills')->get() as $k => $item){
            $this->series[$k]['label'] = $item->region_dan_asp_info .' - '. $item->skills;
            $this->series[$k]['borderColor'] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            $this->series[$k]['fill'] =  'boundary';
            $this->series[$k]['data'] = [];
            foreach(\App\Models\WorkFlowManagement::where(function($table){
                $table->whereYear('date',$this->year);
                if($this->month) $table->whereIn(\DB::raw('MONTH(date)'),$this->month);
            })->where(['region_dan_asp_info'=>$item->region_dan_asp_info,'skills'=>$item->skills])->groupBy('date')->get() as $key_data => $data)
            {
                $this->series[$k]['data'][$key_data] = \App\Models\WorkFlowManagement::where(['date'=>$data->date,'region_dan_asp_info'=>$data->region_dan_asp_info,'skills'=>$data->skills,'wo_close_manual'=>0])->count();
            }
        }
        $this->labels = json_encode($this->labels);
        $this->series = json_encode($this->series);
        $this->legendNames = json_encode($this->legendNames);
        $this->emit('chart-total-ft-never-close-manual',['labels'=>$this->labels,'series'=>$this->series,'legendNames'=>$this->legendNames]);   
    }
}