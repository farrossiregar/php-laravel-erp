<?php
namespace App\Http\Livewire\DutyRosterDophomebase;

use Livewire\Component;
use App\Models\DophomebaseMaster;

class Dashboard extends Component
{
    public $date, $month, $year;
    public $labels,$projects=[];
    public $datasets;

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

        $this->projects = DophomebaseMaster::groupBy('project')->get();
        // foreach($projects as $item){
        //     $this->labels[] = $item->project;
        // }

        

        // $master_dutyroster_sitelist = \App\Models\DutyrosterSitelistMaster::select(DB::Raw("month(created_at) as month"), 'id')
        //                                                                     ->where(DB::Raw('year(created_at)'), $this->year)
        //                                                                     ->where('status', '1')
        //                                                                     ->get();
        // foreach($master_dutyroster_sitelist as $k => $item){
        //     $this->labels[] = date('F', mktime(0, 0, 0, $item->month, 10));
        // }

        // $id_dr = [];
        // foreach($master_dutyroster_sitelist as $k => $item){
        //     $color = ['#ffb1c1','#4b89d6','#add64b','#80b10a','#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];
            
        //     $detail_dutyroster_sitelist = \App\Models\DutyrosterSitelistDetail::select(DB::Raw('count(project) as jumlah'), 'dutyroster_sitelist_detail.*')
        //                                                                         ->where('id_master_dutyroster', $item->id)
        //                                                                         ->where('remarks', '<>', '1')
        //                                                                         // ->groupBy(DB::Raw('month(created_at)'))
        //                                                                         ->groupBy('project')
        //                                                                         ->orderBy('project', 'ASC')
        //                                                                         ->get();
        //     foreach($detail_dutyroster_sitelist as $l => $items){    
                
        //         $this->datasets[$l]['label'] = $items->project.' - '.$items->id_master_dutyroster;
        //         $this->datasets[$l]['backgroundColor'] = $color[$l];
        //         $this->datasets[$l]['fill'] = 'boundary';
        //         $this->datasets[$l]['data'][] = $items->jumlah;
        //     }
        // }
        
        $this->labels = json_encode($this->labels);
        $this->datasets = json_encode($this->datasets);
        $this->emit('init-chart',['labels'=>$this->labels,'datasets'=>$this->datasets]);
    }
}