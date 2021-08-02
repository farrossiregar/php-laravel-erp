<?php

namespace App\Http\Livewire\DatabaseNoc;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PoTrackingPds;
use App\Models\PoTrackingNonms;
use Auth;
use DB;


class Dashboard extends Component
{
    use WithPagination;
    public $date, $month, $year;
    public $labels;
    public $datasets;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $this->generate_chart();
        return view('livewire.database-noc.dashboard');
    }
    
    // public function updated($propertyName)
    public function updated()
    {
        // if($propertyName=='year') $this->month = '';
        $this->generate_chart();
    }
    
    public function generate_chart()
    {
        $this->labels = [];
        $this->datasets = [];

        // $this->year = '2021';
        // $this->month = '07';

        foreach(\App\Models\EmployeeNoc::select("month", "year")->where('year',$this->year)->groupBy('month')->get() as $k => $item){
            $this->labels[] = date('F', mktime(0, 0, 0, $item->month, 10));
        }

        
        foreach(\App\Models\EmployeeNoc::select("month", "year")->where('year',$this->year)->groupBy('month')->get() as $k => $items){
            $color = ['#ffb1c1','#4b89d6'];
            // $this->datasets[] = [];
            $status_employee = ['Resign Personel', 'Active Personel'];
            
            $resign = \App\Models\EmployeeNoc::select("jumlah_resign")->where('month', $items->month)->where('year', $items->year)->first()->jumlah_resign;
            $active = \App\Models\EmployeeNoc::select("jumlah_active")->where('month', $items->month)->where('year', $items->year)->first()->jumlah_active;

            // dd($resign);
            $jumlahpersonel = [$resign, $active];
            $l = 0;
            foreach($status_employee as $j => $itemstatus){ 
                
                $this->datasets[$l]['label'] = $status_employee[$j];
                $this->datasets[$l]['backgroundColor'] = $color[$j];//sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                $this->datasets[$l]['fill'] = 'boundary';
                $this->datasets[$l]['data'][] = $jumlahpersonel[$j];
                $l++;

                // $this->datasets[$k][$j]['label'] = $status_employee[$j];
                // $this->datasets[$k][$j]['backgroundColor'] = $color[$j];//sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                // $this->datasets[$k][$j]['fill'] = 'boundary';
                // // $this->datasets[$k][$j]['data'] = [];
    
                // $this->datasets[$k][$j]['data'][] = $jumlahpersonel[$j];


                // $this->datasets[$k]['label'] = $status_employee[$j];
                // $this->datasets[$k]['backgroundColor'] = $color[$j];//sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                // $this->datasets[$k]['fill'] = 'boundary';
                // $this->datasets[$k]['data'] = [];
                // $jumlahpersonel =  \App\Models\EmployeeNoc::where('month', $items->month)->where('year', $items->year)->first();
    
                // $this->datasets[$k]['data'][] =$jumlahpersonel->jumlah_active;
                // $this->datasets[$k]['data'][] =$jumlahpersonel->jumlah_resign;
    
            }


        }
       
       
        $this->labels = json_encode($this->labels);
        // dd($this->labels);

        $this->datasets = json_encode($this->datasets);
        // dd($this->datasets);

        $this->emit('init-chart',['labels'=>$this->labels,'datasets'=>$this->datasets]);
    }


}



