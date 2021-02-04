<?php

namespace App\Http\Livewire\WorkFlowManagement;

use Livewire\Component;

class AcceptNeverCloseWoManual extends Component
{
    public $year,$month,$labels,$series,$legendNames;
    protected $listeners = ['init-chart-accept-never-close-wo-manual'=>'generate_chart'];
    public function render()
    {
        return view('livewire.work-flow-management.accept-never-close-wo-manual');
    }
    public function mount()
    {
        $this->year = date('Y');
    }
    public function updated($componentName){
        if($componentName=='year') $this->month = '';
        $this->generate_chart();
    }
    public function generate_chart()
    {
        $this->labels = [];$this->legendNames=[];$this->series=[];
        foreach(\App\Models\WorkFlowManagement::where(function($table){
                        $table->whereYear('date',$this->year);
                        if($this->month) $table->whereMonth('date',$this->month);
                    })->groupBy('date')->get() as $item)
        {
            $this->labels[] = date('d/m/y',strtotime($item->date));   
        }
        foreach(\App\Models\WorkFlowManagement::where(function($table){
            $table->whereYear('date',$this->year);
            if($this->month) $table->whereMonth('date',$this->month);
        })->groupBy('region')->get() as $k => $item)
        {
            $this->series[$k]['label'] = $item->region;
            $this->series[$k]['borderColor'] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            $this->series[$k]['fill'] =  'boundary';
            $this->legendNames[$k] = $item->region;
            $this->series[$k]['data'] = [];
            foreach(\App\Models\WorkFlowManagement::where(function($table){
                $table->whereYear('date',$this->year);
                if($this->month) $table->whereMonth('date',$this->month);
            })->where('region',$item->region)->groupBy('date')->get() as $key_data => $data)
            {
                $this->series[$k]['data'][$key_data] = \App\Models\WorkFlowManagement::where('date',$data->date)->where('region',$item->region)->sum('wo_close_manual');
            }
        }
        $this->labels = json_encode($this->labels);
        $this->series = json_encode($this->series);
        $this->legendNames = json_encode($this->legendNames);
        $this->emit('chart-accept-never-close-wo-manual',['labels'=>$this->labels,'series'=>$this->series,'legendNames'=>$this->legendNames]);   
    }
}