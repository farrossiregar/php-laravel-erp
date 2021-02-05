<?php

namespace App\Http\Livewire\Criticalcase;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Criticalcase;

use App\Helpers\GeneralHelper;
use DB;

class Dashboard extends Component
{
    public $start,$end;
    public $labels;
    public $series;
    public $seriess;
    public $project;
    public $region;
    public function render()
    { 
       

        // $labels = $this->labels;
        // $series = $this->series;
        
        $this->generate_chart();
        // return view('livewire.criticalcase.dashboard')->with(compact('labels', 'series'));
        return view('livewire.criticalcase.dashboard');
    }


    public function mount(){
        $this->generate_chart();
    }

    public function generate_chart(){
        $this->labels = [];
        $this->series = [];
        $this->region = [];
        $this->project = [];

        foreach(Criticalcase::where(
            function($table){
                if($this->start) $table->where('date', '>=', $this->start);
                if($this->end) $table->where('date', '<=', $this->end);
                            $table->
                            whereIn('region', ['Sumatera', 'Jabo'])->
                            whereIn('project', ['XL', 'lsat']);
            }
        )->select('date')->groupBy('date')->get() as $k => $item){   
            $dates[$k] = $item->date;        
            foreach(Criticalcase::
                                select(DB::Raw('count(*) as jumlah'))->
                                where('date', $dates[$k])->
                                whereIn('region', ['Sumatera', 'Jabo'])->
                                whereIn('project', ['XL', 'lsat'])->
                                // groupBy('date')->
                                groupBy('region')->get() as $j => $item){
                        $jmlh[$j] = $item->jumlah;
                        // $this->series[] = $jmlh[$k];            
    
            }
            // $series[$k] = $jmlh;
            $this->series[] = $jmlh;
            // $this->labels[] = json_encode(date_format(date_create($item->date), 'd M Y'));           

        }
        

        // dd($this->series);


        foreach(Criticalcase::where(function($table){
                    if($this->start) $table->where('date', '>=', $this->start);
                    if($this->end) $table->where('date', '<=', $this->end);
                    // if($this->region) $table->whereIn('region', [$this->region]);
                    // if($this->project) $table->whereIn('project', [$this->project]);
                                    $table->
                                    whereIn('region', ['Sumatera', 'Jabo'])->
                                    whereIn('project', ['XL', 'lsat']);
                                })->select('date')->
                                groupBy('date')->get() as $item){        
                    $this->labels[] = json_encode(date_format(date_create($item->date), 'd M Y'));           

        }

        $this->labels = $this->labels;
        $this->series = $this->series;
        $this->seriess = [[12, 24], [5, 10], [15, 30], [7, 14], [10, 20], [9, 27], [16, 32], [11, 22]];
        $this->seriess = $this->seriess;
        
        
        $this->emit('init-chart',['labels'=>$this->labels,'series'=>$this->series, 'region'=>$this->region, 'seriess'=>$this->seriess]);
    }
}
