<?php

namespace App\Http\Livewire\HotelFlightTicket;

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
        return view('livewire.hotel-flight-ticket.dashboard');
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

        // dd($this);

        $color = ['#ffb1c1','#4b89d6', '#007bff','#28a745','#333333'];
        
        $weeks = ['1', '2', '3', '4', '5'];
        $tickettype = ['1', '2'];

        // foreach(\App\Models\ToolsNoc::where('year',$this->year)->where('type', $this->type)->where('status', '1')->groupBy('month')->get() as $k => $item){
        //     $this->labels[$k] = date('F', mktime(0, 0, 0, (int)$item->month, 10));
        // }
        
        // foreach(\App\Models\ToolsNoc::where('year',$this->year)->where('type', $this->type)->where('status', '1')->groupBy('month')->get() as $k => $item){
        //     foreach($weeks as $j => $itemstatus){ 
        //         // $this->datasets[$k]['label'] = 'Week '.$weeks[$j];
        //         $this->datasets[$j]['label'] = 'Week '.$weeks[$j];
        //         // $this->datasets[$k]['label'] = date('F', mktime(0, 0, 0, (int)$item->month, 10));
        //         // $this->datasets[$k]['label'] = '1';
        //         $this->datasets[$j]['backgroundColor'] = $color[$j];
        //         $this->datasets[$k]['fill'] = 'boundary';
        //         $this->datasets[$j]['data'][] = count(\App\Models\Employee::where('is_noc', 1)->where('is_resign', 0)->get()) - \App\Models\ToolsNoc::select(DB::Raw('count(week) as jumlah'))->where('year',$item->year)->where('month',$item->month)->where('week',$weeks[$j])->where('type', $this->type)->where('status', '1')->first()->jumlah;
        //         // $this->datasets[$k]['data'][] = \App\Models\ToolsNoc::where('year',$item->year)->where('month',$item->month)->where('week',$weeks[$j])->where('status','1')->first();   
        //     }
        // }
       
        foreach(\App\Models\HotelFlightTicket::whereYear('date',$this->year)->whereMonth('date', $this->month)->where('project', $this->project)->where('status', '2')->get() as $k => $item){
            $this->labels[$k] = date('F', mktime(0, 0, 0, (int)$item->month, 10));
        }
        
        
        
        foreach($tickettype as $j => $itemstatus){ 
            // $this->datasets[$k]['label'] = 'Week '.$weeks[$j];
            // $this->datasets[$j]['label'] = $itemstatus[$j];
            $this->datasets[$j]['label'] = ($itemstatus == '1') ? 'Hotel & Flight' : 'Hotel Only';
            // $this->datasets[$j]['label'] = '';
            // $this->datasets[$k]['label'] = date('F', mktime(0, 0, 0, (int)$item->month, 10));
            // $this->datasets[$k]['label'] = '1';
            $this->datasets[$j]['backgroundColor'] = $color[$j];
            $this->datasets[$j]['fill'] = 'boundary';
                                            // dd(\App\Models\HotelFlightTicket::whereYear('date', '2021')->whereMonth('date', '12')->where('client_project_id', '9')->where('ticket_type', '2')->where('status', '2')->get());
            $this->datasets[$j]['data'][] = count(\App\Models\HotelFlightTicket::whereYear('date', '2021')->whereMonth('date', '12')->where('client_project_id', '9')->where('ticket_type', $itemstatus)->where('status', '0')->get());
            // $this->datasets[$j]['data'][] = count(\App\Models\HotelFlightTicket::whereYear('date', $this->year)->whereMonth('date', $this->month)->where('client_project_id', $this->project)->where('ticket_type', '2')->where('status', '0')->get());
            // $this->datasets[$k]['data'][] = \App\Models\ToolsNoc::where('year',$item->year)->where('month',$item->month)->where('week',$weeks[$j])->where('status','1')->first();   
        }


        $hprice = \App\Models\HotelFlightTicket::select(DB::Raw('sum(hotel_price) as hotelprice'))->whereYear('date', '2021')->whereMonth('date', '12')->where('client_project_id', '9')->where('ticket_type', $itemstatus)->where('status', '0')->groupBy(DB::Raw('month(date)'))->first()->price;
        $fprice = \App\Models\HotelFlightTicket::select(DB::Raw('sum(flight_price) as flightprice'))->whereYear('date', '2021')->whereMonth('date', '12')->where('client_project_id', '9')->where('ticket_type', $itemstatus)->where('status', '0')->groupBy(DB::Raw('month(date)'))->first()->price;
        foreach($tickettype as $j => $itemstatus){ 
            $this->datasetsamount[$j]['label'] = ($itemstatus == '1') ? 'Hotel & Flight' : 'Hotel Only';
            $this->datasetsamount[$j]['backgroundColor'] = $color[$j];
            $this->datasetsamount[$j]['fill'] = 'boundary';
            $this->datasetsamount[$j]['data'][] = ($hprice) ? $hprice : 0;
        }
    
        $this->labels = json_encode($this->labels);
        $this->datasets = json_encode($this->datasets);

        // $this->labelsamount = json_encode($this->labelsamount);
        $this->datasetsamount = json_encode($this->datasetsamount);
        // dd(\App\Models\HotelFlightTicket::select(DB::Raw('sum(hotel_price) as hotelprice'))->whereYear('date', '2021')->whereMonth('date', '12')->where('client_project_id', '9')->where('ticket_type', $itemstatus)->where('status', '0')->groupBy(DB::Raw('month(date)'))->first()->hotelprice);
        $this->emit('init-chart',['labels'=>$this->labels,'datasets'=>$this->datasets,'datasetsamount'=>$this->datasetsamount]);
    }


}



