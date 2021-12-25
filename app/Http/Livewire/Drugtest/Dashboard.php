<?php

namespace App\Http\Livewire\Drugtest;

use Livewire\Component;
use App\Models\DrugTest;
use App\Models\Employee;

class Dashboard extends Component
{
    public $filter_tahun,$labels,$series,$tahun,$notInt,$positive,$negative;
    public $total_team,$done_drug_test,$not_yet_drug_test;
    public $background = ['#9ad0f5','#ffb1c1','#8fe045','#4f805d','#0b57cab0'];   
    public function render()
    {  
        return view('livewire.drugtest.dashboard');
    }

    public function mount()
    {
        $this->tahun  = DrugTest::groupBy('tahun')->get();
        $this->chart();
    }

    public function chart()
    {
        $this->labels = [];$this->series=[];
        $this->notIn = DrugTest::pluck('employee_id')->toArray();
        $this->labels[] = "Drug Test";
        foreach([0=>'Positive',1=>'Negative',2=>'Not Yet Drug Test',3=>'Done Drug Test',4=>'Total Team'] as $k=>$item){
            $this->series[$k]['label'] = $item;
            $this->series[$k]['borderColor'] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            $this->series[$k]['fill'] =  'boundary';
            $this->series[$k]['backgroundColor'] = $this->background[$k];
            $this->series[$k]['data'] = [];
            if($k==0){
                $this->positive = DrugTest::where('status_drug',1)->get()->count();
                $this->series[$k]['data'][] = $this->positive;
            }
            if($k==1){
                $this->negative = DrugTest::where('status_drug',2)->get()->count();
                $this->series[$k]['data'][] = $this->negative;
            }
            if($k==2){
                $this->not_yet_drug_test = Employee::whereNotIn('id',$this->notIn)->get()->count();
                $this->series[$k]['data'][] = $this->not_yet_drug_test;
            }
            if($k==3){
                $this->done_drug_test = DrugTest::get()->count();
                $this->series[$k]['data'][] = $this->done_drug_test;
            }
            if($k==4){
                $this->total_team = Employee::get()->count();
                $this->series[$k]['data'][] = $this->total_team;
            }
        }   

        $this->labels = json_encode($this->labels);
        $this->series = json_encode($this->series);
        $this->emit('init-chart',['labels'=>$this->labels,'series'=>$this->series]);
    }
}