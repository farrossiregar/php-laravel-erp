<?php

namespace App\Http\Livewire\WorkFlowManagement;

use Livewire\Component;

class TotalFtNeverCloseManual extends Component
{
    public $year,$month,$labels,$series,$legendNames;
    protected $listeners = ['init-chart-total-ft-never-close-manual'=>'generate_chart'];
    public function render()
    {
        return view('livewire.work-flow-management.total-ft-never-close-manual');
    }
    public function mount()
    {
        $this->year = date('Y');
        $this->generate_chart();
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
        })->groupBy('servicearea2')->get() as $k => $item)
        {
            $this->series[$k]['label'] = $item->servicearea2;
            $this->series[$k]['borderColor'] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            $this->series[$k]['fill'] =  'boundary';
            $this->legendNames[$k] = $item->servicearea2;
            $this->series[$k]['data'] = [];
            foreach(\App\Models\WorkFlowManagement::where(function($table){
                $table->whereYear('date',$this->year);
                if($this->month) $table->whereMonth('date',$this->month);
            })->where('servicearea2',$item->servicearea2)->groupBy('date')->get() as $key_data => $data)
            {
                $this->series[$k]['data'][$key_data] = \App\Models\WorkFlowManagement::where('date',$data->date)->where('servicearea2',$item->servicearea2)->sum('wo_close_manual');
            }
        }
        $this->labels = json_encode($this->labels);
        $this->series = json_encode($this->series);
        $this->legendNames = json_encode($this->legendNames);
        $this->emit('chart-total-ft-never-close-manual',['labels'=>$this->labels,'series'=>$this->series,'legendNames'=>$this->legendNames]);   
    }
}