<?php

namespace App\Http\Livewire\DatabaseToolsNoc;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\EmployeeNoc;

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
        return view('livewire.database-tools-noc.dashboard');
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

        foreach(EmployeeNoc::select("month", "year")->where('year',$this->year)->whereNotNull('month')->groupBy('month')->get() as $k => $item){
            $this->labels[] = date('F', mktime(0, 0, 0, (int)$item->month, 10));
        }

        $color = ['#ffb1c1','#4b89d6'];
        $status_employee = ['Resign Personel', 'Active Personel'];

        foreach(EmployeeNoc::select("month", "year")->where('year',$this->year)->groupBy('month')->get() as $k => $items){
            $resign = EmployeeNoc::where('month', $items->month)->where('year', $items->year)->count();
            $active = EmployeeNoc::where('month', $items->month)->where('year', $items->year)->count();

            $jumlahpersonel = [$resign, $active];
            $l = 0;
            foreach($status_employee as $j => $itemstatus){ 
                
                $this->datasets[$l]['label'] = $status_employee[$j];
                $this->datasets[$l]['backgroundColor'] = $color[$j];
                $this->datasets[$l]['fill'] = 'boundary';
                $this->datasets[$l]['data'][] = $jumlahpersonel[$j];
                $l++;
            }
        }   
    
        $this->labels = json_encode($this->labels);
        $this->datasets = json_encode($this->datasets);

        $this->emit('init-chart',['labels'=>$this->labels,'datasets'=>$this->datasets]);
    }


}



