<?php

namespace App\Http\Livewire\Criticalcase;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Criticalcase;

use App\Helpers\GeneralHelper;
use DB;

class Dashboard extends Component
{
    public $start,$end,$year,$datasets,$month;
    public $labels;
    //public $series;
    //public $seriess;
    public $project;
    public $region;
    public function render()
    { 
       

        // $labels = $this->labels;
        // $series = $this->series;
        
        //$this->generate_chart();
        // return view('livewire.criticalcase.dashboard')->with(compact('labels', 'series'));   
        return view('livewire.criticalcase.dashboard');
    }

    // ketika ada filter / perubahan di form maka di generate ulang chart berdasarkan data yang dirubah di formnya
    public function updated()
    {
        $this->generate_chart();
    }
    // set default ketika pertama kali load halaman
    public function mount(){
        $this->year = date('Y');
        $this->generate_chart();
    }

    public function generate_chart(){
        $this->labels = [];
        //$this->series = [];
        $this->datasets = [];

        foreach(Criticalcase::whereYear('date',$this->year)->where(function($table){
            if($this->month) $table->whereMonth('date',$this->month);
            if($this->region) $table->whereIn('region',$this->region);
            if($this->project) $table->whereIn('project',$this->project);
        })->groupBy('date')->get() as $item){
            $this->labels[] = $item->date;
        }
        foreach(Criticalcase::groupBy('region')->where(function($table){
            if($this->region) $table->whereIn('region',$this->region);    
            if($this->project) $table->whereIn('project',$this->project);    
        })->get() as $key => $item){
            $this->datasets[$key]['label'] = $item->region;
            $this->datasets[$key]['backgroundColor'] = sprintf('#%06X', mt_rand(0, 0xFFFFFF)); // generate warna
            $this->datasets[$key]['borderColor'] = sprintf('#%06X', mt_rand(0, 0xFFFFFF)); // generate warna
            $this->datasets[$key]['borderWidth'] = 1;
            $this->datasets[$key]['data'] = [];
            foreach($this->labels as $date){
                $this->datasets[$key]['data'][]  = Criticalcase::where(['date'=>$date,'region'=>$item->region])->where(function($table){
                    if($this->project) $table->whereIn('project',$this->project);
                })->count();
            }
        }

        $this->labels = json_encode($this->labels); 
        $this->datasets = json_encode($this->datasets); 
        $this->emit('init-chart-critical-case',['labels'=>$this->labels,'datasets'=>$this->datasets]);
    }
}
