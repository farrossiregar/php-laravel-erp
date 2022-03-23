<?php

namespace App\Http\Livewire\WorkFlowManagement;

use Livewire\Component;
use App\Models\WorkFlowManagement;

class TotalFtNeverCloseManual extends Component
{
    public $year,$month,$labels,$series,$legendNames,$region;
    protected $listeners = [
        'refresh-page'=>'$refresh',
        'emit-year' => 'filterYear',
        'emit-month' => 'filterMonth',
        'emit-region' => 'filterRegion',
        'init-chart-total-ft-never-close-manual'=>'generate_chart'
    ];
    public function render()
    {
        return view('livewire.work-flow-management.total-ft-never-close-manual');
    }
    public function mount()
    {
        $this->year = date('Y');
        $this->generate_chart();
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

        if($this->month) 
            foreach($this->month as $k => $m) 
                if($m!=false) 
                    $this->month[$k] = $m; 
                else 
                    unset($this->month[$k]);

        foreach(WorkFlowManagement::where(function($table){
                        $table->whereYear('date',$this->year);
                        if($this->month) $table->whereIn(\DB::raw('MONTH(date)'),$this->month);
                    })->groupBy('date')->get() as $item){
            $this->labels[] = date('d/m/y',strtotime($item->date));   
        }

        foreach(WorkFlowManagement::where(function($table){
            $table->whereYear('date',$this->year);
            if($this->month) $table->whereIn(\DB::raw('MONTH(date)'),$this->month);
            if($this->region) $table->whereIn('region',$this->region);
        })->groupBy('region')->get() as $k => $item){
            $this->series[$k]['label'] = $item->region;
            $this->series[$k]['borderColor'] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            $this->series[$k]['fill'] =  'boundary';
            $this->series[$k]['data'] = [];
            
            foreach(WorkFlowManagement::where(function($table){
                $table->whereYear('date',$this->year);
                if($this->month) $table->whereIn(\DB::raw('MONTH(date)'),$this->month);
            })->where('region',$item->region)->groupBy('date')->get() as $key_data => $data){
                $this->series[$k]['data'][$key_data] = WorkFlowManagement::where(['date'=>$data->date,'region'=>$data->region])->count();
            }
        }

        foreach(WorkFlowManagement::whereYear('date',$this->year)->where(function($table){
            if($this->month) $table->whereIn(\DB::raw('MONTH(date)'),$this->month);
            if($this->region) $table->whereIn('region',$this->region);
        })->groupBy('region')->get() as $item){
            $base_line = [];
            $base_line['type'] = 'line';
            $base_line['label'] = 'Threshold - '.$item->region;
            $base_line['borderWidth'] = 0.5;
            $base_line['data'] = [];
            $base_line['fill'] = false;
            $base_line['borderColor']= '#FF0000';
            $base_line['data'] = [];
            
            foreach(WorkFlowManagement::where(function($table){
                $table->whereYear('date',$this->year);
                if($this->month) $table->whereIn(\DB::raw('MONTH(date)'),$this->month);
            })->where('region',$item->region)->groupBy('date')->get() as $key_data => $data){
                $base_line['data'][$key_data] = $data->threshold;
            }
            $this->series[] =  $base_line;
        }

        $this->labels = json_encode($this->labels);
        $this->series = json_encode($this->series);
        $this->legendNames = json_encode($this->legendNames);

        $this->emit('chart-total-ft-never-close-manual',['labels'=>$this->labels,'series'=>$this->series,'legendNames'=>$this->legendNames]);   
    }
}