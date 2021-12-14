<?php

namespace App\Http\Livewire\DutyRoster;

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
        return view('livewire.duty-roster.dashboard');
    }
    
    public function updated()
    {
        $this->generate_chart();
    }
    
    public function generate_chart()
    {
        $this->labels = [];
        $this->datasets = [];

        $master_dutyroster_sitelist = \App\Models\DutyrosterSitelistMaster::select(DB::Raw("month(created_at) as month"), 'id')
                                                                            ->where(DB::Raw('year(created_at)'), $this->year)
                                                                            ->where('status', '1')
                                                                            ->get();
        foreach($master_dutyroster_sitelist as $k => $item){
            $this->labels[] = date('F', mktime(0, 0, 0, $item->month, 10));
        }

        $id_dr = [];
        foreach($master_dutyroster_sitelist as $k => $item){
            $color = ['#ffb1c1','#4b89d6','#add64b','#80b10a','#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];
            
            $detail_dutyroster_sitelist = \App\Models\DutyrosterSitelistDetail::select(DB::Raw('count(project) as jumlah'), 'dutyroster_sitelist_detail.*')
                                                                                ->where('id_master_dutyroster', $item->id)
                                                                                ->where('remarks', '<>', '1')
                                                                                ->groupBy('project')
                                                                                ->orderBy('project', 'ASC')
                                                                                ->get();
            foreach($detail_dutyroster_sitelist as $l => $items){    
                
                $this->datasets[$l]['label'] = $items->project.' - '.$items->id_master_dutyroster;
                $this->datasets[$l]['backgroundColor'] = $color[$l];
                $this->datasets[$l]['fill'] = 'boundary';
                $this->datasets[$l]['data'][] = $items->jumlah;
     
            }

        }

        $this->labels = json_encode($this->labels);
        $this->datasets = json_encode($this->datasets);

        $this->emit('init-chart',['labels'=>$this->labels,'datasets'=>$this->datasets]);
    }


}



