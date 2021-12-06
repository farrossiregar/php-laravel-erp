<?php

namespace App\Http\Livewire\TeamSchedule;

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
        return view('livewire.team-schedule.dashboard');
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

        $this->year = '2021';

        $month_pettycash = \App\Models\PettyCash::select(DB::Raw("month(created_at) as month"), 'id')
                                                                            ->where(DB::Raw('year(created_at)'), $this->year)
                                                                            ->where('status_receipt', '1')
                                                                            ->groupBy(DB::Raw("month(created_at)"))
                                                                            ->get();
        foreach($month_pettycash as $k => $item){
            $this->labels[] = date('F', mktime(0, 0, 0, $item->month, 10));
            // $this->labels[] = $item->id;
        }

        // dd($this->labels);
        
        
        $id_dr = [];
        foreach($month_pettycash as $k => $item){
            $color = ['#ffb1c1','#4b89d6','#add64b','#80b10a','#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];
            
            $detail_pettycash = \App\Models\PettyCash::select(DB::Raw('sum(amount) as jumlah'))
                                                        ->where(DB::Raw('month(created_at)'), $item->month)                   
                                                        ->where(DB::Raw('year(created_at)'), $this->year)     
                                                        ->where('status_receipt', '1')      
                                                        ->groupBy(DB::Raw('month(created_at)'))        
                                                        ->groupBy(DB::Raw('year(created_at)'))        
                                                        ->get();
            foreach($detail_pettycash as $l => $items){    
                
                // $this->datasets[$l]['label'] = date('F', mktime(0, 0, 0, $item->month, 10)).' - Rp.'.format_idr($items->jumlah);
                $this->datasets[$l]['label'] = date('F', mktime(0, 0, 0, $item->month, 10));
                $this->datasets[$l]['backgroundColor'] = $color[$l];
                $this->datasets[$l]['fill'] = 'boundary';
                $this->datasets[$l]['data'][] = $items->jumlah;
     
            }

        }

        // dd($this->datasets);

       
        $this->labels = json_encode($this->labels);
        // dd($this->labels);

        $this->datasets = json_encode($this->datasets);
        // dd($this->datasets);

        $this->emit('init-chart',['labels'=>$this->labels,'datasets'=>$this->datasets]);
    }


}



