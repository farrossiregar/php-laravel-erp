<?php

namespace App\Http\Livewire\DutyRoster;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\DutyrosterSitelistDetail;
use DB;

class Dashboard extends Component
{
    use WithPagination;
    public $date, $month, $year;
    public $labels;
    public $datasets,$color = ['#ffb1c1','#4b89d6','#add64b','#80b10a','#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $this->generate_chart();
        return view('livewire.duty-roster.dashboard');
    }

    public function mount()
    {
        $this->year = date('Y');
    }
    
    public function updated()
    {
        $this->generate_chart();
    }
    
    public function generate_chart()
    {
        $this->labels = [];
        $this->datasets = [];
        
        for($bulan=1;$bulan<=12;$bulan++) {
            $this->labels[] = date('F', mktime(0, 0, 0, $bulan, 10));

            
        }

        $projects = DutyrosterSitelistDetail::groupBy('project')->get();
        foreach($projects as $key_project => $project){
            $detail_dutyroster_sitelist = DutyrosterSitelistDetail::select(DB::Raw('count(project) as jumlah'), 'dutyroster_sitelist_detail.*')
                                                                                ->where('remarks', '<>', '1')
                                                                                ->groupBy('project')
                                                                                ->whereMonth('created_at',$bulan)
                                                                                ->whereYear('created_at',$this->year)
                                                                                ->orderBy('project', 'ASC')
                                                                                ->get();
            foreach($detail_dutyroster_sitelist as $l => $items){
                $this->datasets[$l]['label'] = $items->project;
                $this->datasets[$l]['backgroundColor'] = $this->color[$l];
                $this->datasets[$l]['fill'] = 'boundary';
                $this->datasets[$l]['data'][] = $items->jumlah;
            }

            for($bulan=1;$bulan<=12;$bulan++) {
                
            }
        }

        if(isset($_GET['debug'])) dd($this->datasets);
        
        $this->labels = json_encode($this->labels);
        $this->datasets = json_encode($this->datasets);
        $this->emit('init-chart',['labels'=>$this->labels,'datasets'=>$this->datasets]);
    }
}