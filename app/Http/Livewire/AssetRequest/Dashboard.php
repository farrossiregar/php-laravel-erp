<?php

namespace App\Http\Livewire\AssetRequest;

use Livewire\Component;
use Livewire\WithPagination;
// use App\Models\EmployeeNoc;
use DB;

class Dashboard extends Component
{
    use WithPagination;
    public $date, $month, $year, $type;
    public $labels;
    public $datasets;
    public $labelsamount;
    public $datasetsamount;
    public $project;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $this->generate_chart();
        return view('livewire.asset-request.dashboard');
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
        $this->datasetsamount = [];

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

        // if($this->project){
        //     dd($this->project);
        // }


        $color = ['#ffb1c1','#4b89d6', '#007bff','#28a745','#333333'];
        
        // $weeks = ['1', '2', '3', '4', '5'];
        $tickettype = ['1', '2'];
       
        foreach(\App\Models\HotelFlightTicket::whereYear('date',$this->year)->whereMonth('date', $this->month)->where('project', $this->project)->where('status', '2')->get() as $k => $item){
            $this->labels[$k] = date('F', mktime(0, 0, 0, (int)$item->month, 10));
        }
        
        
        foreach($tickettype as $j => $itemstatus){ 
            $this->datasets[$j]['label']                = ($itemstatus == '1') ? 'Hotel & Flight' : 'Hotel Only';
            // $this->datasets[$k]['label'] = date('F', mktime(0, 0, 0, (int)$item->month, 10));
            $this->datasets[$j]['backgroundColor']      = $color[$j];
            $this->datasets[$j]['fill']                 = 'boundary';
            $this->datasets[$j]['data'][]               = count(\App\Models\HotelFlightTicket::whereYear('date', $this->year)->whereMonth('date', $this->month)->where('client_project_id', $this->project)->where('ticket_type', $itemstatus)->where('status', '2')->get());
        }


        
        foreach($tickettype as $j => $itemstatus){ 
            $hprice = \App\Models\HotelFlightTicket::select(DB::Raw('sum(hotel_price) as hotelprice'))->whereYear('date', $this->year)->whereMonth('date', $this->month)->where('client_project_id', $this->project)->where('ticket_type', $itemstatus)->where('status', '2')->groupBy(DB::Raw('month(date)'));
            $hprice = ($hprice->first()) ? $hprice->first()->hotelprice : 0;
            $fprice = \App\Models\HotelFlightTicket::select(DB::Raw('sum(flight_price) as flightprice'))->whereYear('date', $this->year)->whereMonth('date', $this->month)->where('client_project_id', $this->project)->where('ticket_type', $itemstatus)->where('status', '2')->groupBy(DB::Raw('month(date)'));
            $fprice = ($fprice->first()) ? $fprice->first()->flightprice : 0;
            $this->datasetsamount[$j]['label']              = ($itemstatus == '1') ? 'Hotel & Flight' : 'Hotel Only';
            $this->datasetsamount[$j]['backgroundColor']    = $color[$j];
            $this->datasetsamount[$j]['fill']               = 'boundary';
            $this->datasetsamount[$j]['data'][]             = $hprice + $fprice;

        }
    
        $this->labels = json_encode($this->labels);
        $this->datasets = json_encode($this->datasets);
        $this->datasetsamount = json_encode($this->datasetsamount);
        // dd(\App\Models\HotelFlightTicket::select(DB::Raw('sum(hotel_price) as hotelprice'))->whereYear('date', '2021')->whereMonth('date', '12')->where('client_project_id', '9')->where('ticket_type', $itemstatus)->where('status', '0')->groupBy(DB::Raw('month(date)'))->first()->hotelprice);
        $this->emit('init-chart',['labels'=>$this->labels,'datasets'=>$this->datasets,'datasetsamount'=>$this->datasetsamount]);
    }


}



