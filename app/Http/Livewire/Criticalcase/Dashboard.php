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
    public $project = [];
    public $region;
    public function render()
    { 
        return view('livewire.criticalcase.dashboard');
    }


    public function mount(){

        if($this->start){
            $ata = $data->where('date', '>=', $this->start);
        }

        if($this->end){
            $ata = $data->where('date', '<=', $this->end);
        }
                 
        // if($this->region){
        //     dd($this->region);
        // }

        $this->generate_chart();
    }

    public function generate_chart(){
        $data = Criticalcase::select('*');

        $this->labels = array('S', 'M', 'T', 'W', 'T', 'F', 'S');
        $this->series = array(18, 22, 96, 5, 2, 29, 58);
        $this->emit('init-chart',['labels'=>$this->labels,'series'=>$this->series]);
    }
}
