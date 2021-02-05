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
    public $project;
    public $region;
    public function render()
    { 
        // $this->labels = [];
        // $this->series = [];
        // $this->region = [];
        // $this->project = [];


        // foreach(Criticalcase::where(function($table){
        //     if($this->start) $table->where('date', '>=', $this->start);
        //     if($this->end) $table->where('date', '<=', $this->end);
        //     // if($this->region) $table->whereIn('region', [$this->region]);
        //     // if($this->project) $table->whereIn('project', [$this->project]);
        //                     $table->
        //                     whereIn('region', ['Sumatera', 'Jabo'])->
        //                     whereIn('project', ['XL', 'lsat']);
        //                 })->select(DB::Raw('count(*) as jumlah'))->
        //                 groupBy('date')->
        //                 groupBy('region')->get() as $item){
        //     $this->series[] = $item->jumlah;            

        // }

        // // dd(json_encode($this->series));

        // foreach(Criticalcase::where(function($table){
        //     if($this->start) $table->where('date', '>=', $this->start);
        //     if($this->end) $table->where('date', '<=', $this->end);
        //                     $table->
        //                     whereIn('region', ['Sumatera', 'Jabo'])->
        //                     whereIn('project', ['XL', 'lsat']);
        //                 })->select('date')->
        //                 groupBy('date')->get() as $item){
        //     $this->labels[] = json_encode(date_format(date_create($item->date), 'd M Y')); 

        // }


        // $labels = $this->labels;
        // $series = $this->series;
        
        // $this->generate_chart();
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


        foreach(Criticalcase::where(function($table){
                    if($this->start) $table->where('date', '>=', $this->start);
                    if($this->end) $table->where('date', '<=', $this->end);
                    // if($this->region) $table->whereIn('region', [$this->region]);
                    // if($this->project) $table->whereIn('project', [$this->project]);
                                    $table->
                                    whereIn('region', ['Sumatera', 'Jabo'])->
                                    whereIn('project', ['XL', 'lsat']);
                                })->select(DB::Raw('count(*) as jumlah'))->
                                groupBy('date')->
                                groupBy('region')->get() as $item){
                    $this->series[] = $item->jumlah;            

        }


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
        
        $this->emit('init-chart',['labels'=>$this->labels,'series'=>$this->series, 'region'=>$this->region]);
    }
}
