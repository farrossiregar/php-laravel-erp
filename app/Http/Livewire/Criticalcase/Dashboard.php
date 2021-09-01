<?php

namespace App\Http\Livewire\Criticalcase;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Criticalcase;

use App\Helpers\GeneralHelper;
use DB;

class Dashboard extends Component
{
    public $start,$end,$year,$datasets,$month,$datasets_pie=[],$labels_pie=[],$action_point=[];
    public $labels;
    public $project;
    public $region;
    public function render()
    { 
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
        $this->action_point = ['Repetitive','Non Repetitive'];
        $this->generate_chart();
    }

    public function generate_chart()
    {
        $this->labels = [];
        $this->datasets = [];

        foreach(Criticalcase::whereYear('date',$this->year)->where(function($table){
            if($this->month) $table->whereMonth('date',$this->month);
            if($this->region) $table->whereIn('region',$this->region);
            if($this->project) $table->whereIn('project',$this->project);
        })->groupBy('date')->get() as $item){
            $this->labels[] = $item->date;
        }
        $colors = ['#de4848','#3C89DA'];
        foreach($this->action_point as $key => $name){
            $this->datasets[$key]['label'] = $name;
            $this->datasets[$key]['backgroundColor'] = $colors[$key]; // generate warna
            $this->datasets[$key]['borderColor'] = $colors[$key]; // generate warna
            $this->datasets[$key]['borderWidth'] = 1;
            $this->datasets[$key]['data'] = [];

            foreach($this->labels as $date){
                $this->datasets[$key]['data'][]  = Criticalcase::where(['date'=>$date])->where(function($table)use($key){
                    if($key==0) $table->where('type',1);
                    if($key==1) $table->where('type',2);
                    if($this->project) $table->whereIn('project',$this->project);
                    if($this->month) $table->whereMonth('date',$this->month);
                    if($this->region) $table->whereIn('region',$this->region);
                })->count();
            }
        }


        // foreach(Criticalcase::groupBy('region')->where(function($table){
        //     if($this->region) $table->whereIn('region',$this->region);    
        //     if($this->project) $table->whereIn('project',$this->project);    
        // })->get() as $key => $item){
        //     $this->datasets[$key]['label'] = $item->region;
        //     $this->datasets[$key]['backgroundColor'] = sprintf('#%06X', mt_rand(0, 0xFFFFFF)); // generate warna
        //     $this->datasets[$key]['borderColor'] = sprintf('#%06X', mt_rand(0, 0xFFFFFF)); // generate warna
        //     $this->datasets[$key]['borderWidth'] = 1;
        //     $this->datasets[$key]['data'] = [];
        //     foreach($this->labels as $date){
        //         $this->datasets[$key]['data'][]  = Criticalcase::where(['date'=>$date,'region'=>$item->region])->where(function($table){
        //             if($this->project) $table->whereIn('project',$this->project);
        //         })->count();
        //     }
        // }

        $labels = ['Repetitive','Non Repetitive'];
        foreach($labels as $k => $label){
            
        }

        $this->labels_pie = json_encode($this->labels_pie); 
        $this->datasets_pie = json_encode($this->datasets_pie); 

        $this->labels = json_encode($this->labels); 
        $this->datasets = json_encode($this->datasets); 
        $this->emit('init-chart-critical-case',['labels'=>$this->labels,'datasets'=>$this->datasets]);
    }
}
