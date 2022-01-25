<?php

namespace App\Http\Livewire\ClaimingProcess;

use Livewire\Component;
use Livewire\WithPagination;
use Session;
use DB;

class Dashboard extends Component
{
    use WithPagination;
    public $date, $month, $year, $type;
    public $labels;
    public $datasets;
    public $labelsamount;
    public $datasetsamount;
    public $project, $dataproject;
    public $region;
    public $aging;

    public $total, $reject;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
       
        $this->dataproject = [];

        $this->dataproject = \App\Models\ClientProject::orderBy('id', 'desc')
                                
                                ->where('company_id', Session::get('company_id'))
                                ->where('is_project', '1')
                                ->get();

        $this->generate_chart();
        return view('livewire.claiming-process.dashboard');
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
     

        $this->total = [];
        $this->reject = [];

        if($this->year){
            $this->year = $this->year;
        }else{
            $this->year = date('Y');
        }

        if($this->month){
            $this->month = $this->month;
        }else{
            $this->month = date('m');
        }

            
        $total = \App\Models\ClaimingProcess::select('claiming_process.*')
                                            ->join('hotel_flight_ticket_request', 'claiming_process.ticket_id', '=', 'hotel_flight_ticket_request.ticket_id')
                                            ->whereMonth('claiming_process.created_at', $this->month)
                                            ->whereYear('claiming_process.created_at', $this->year);


        $reject = \App\Models\ClaimingProcess::select('claiming_process.*')
                                            ->join('hotel_flight_ticket_request', 'claiming_process.ticket_id', '=', 'hotel_flight_ticket_request.ticket_id')
                                            ->where('claiming_process.status', '0')
                                            ->whereMonth('claiming_process.created_at', $this->month)
                                            ->whereYear('claiming_process.created_at', $this->year);

        if($this->project){
            $total = $total->where('hotel_flight_ticket_request.project', $this->project);
            $reject = $reject->where('hotel_flight_ticket_request.project', $this->project);
        }
        
        $this->total = count($total->get());
        $this->reject = count($reject->get());

        $this->total = json_encode($this->total);
        $this->reject = json_encode($this->reject);
    
       
        $this->emit('init-chart',['total'=>$this->total,'reject'=>$this->reject]);
    }


}



