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
    public $pie1, $pie2;
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
        $this->datasetsamount = [];
        $this->pie1 = [];
        $this->pie2 = [];

        if($this->year){
            $this->year = $this->year;
        }else{
            $this->year = date('Y');
            // $this->year = '2021';
        }


        $color = ['#ffb1c1','#4b89d6', '#007bff','#28a745','#333333'];
        
        $tickettype = ['1', '2'];

        if($this->project){
            $labelsreq = \App\Models\HotelFlightTicket::whereYear('date',$this->year)->where('project', $this->project)->where('status', '2')->groupBy(DB::Raw('month(date)'))->get();
        }else{
            $labelsreq = \App\Models\HotelFlightTicket::whereYear('date',$this->year)->where('status', '2')->groupBy(DB::Raw('month(date)'))->get();
        }


        foreach($labelsreq as $k => $item){
        // foreach(\App\Models\HotelFlightTicket::whereYear('date',$this->year)->where('project', $this->project)->where('status', '2')->groupBy(DB::Raw('month(date)'))->get() as $k => $item){
        // foreach($datareq->groupBy(DB::Raw('month(date)'))->get() as $k => $item){
            $this->labels[$k] = date_format(date_create($item->date), 'M');
        }

        // foreach($tickettype as $j => $itemstatus){ 
        //     $this->datasets[$j]['label']                = ($itemstatus == '1') ? 'Hotel & Flight' : 'Hotel Only';
        //     // $this->datasets[$k]['label'] = date('F', mktime(0, 0, 0, (int)$item->month, 10));
        //     $this->datasets[$j]['backgroundColor']      = $color[$j];
        //     $this->datasets[$j]['fill']                 = 'boundary';
        //     $this->datasets[$j]['data'][]               = count(\App\Models\HotelFlightTicket::whereYear('date', $this->year)->whereMonth('date', $this->month)->where('client_project_id', $this->project)->where('ticket_type', $itemstatus)->where('status', '2')->get());
        // }

        foreach($labelsreq as $k => $item){
        // foreach(\App\Models\HotelFlightTicket::whereYear('date',$this->year)->where('project', 'STP MS Project')->where('status', '2')->groupBy(DB::Raw('month(date)'))->get() as $k => $item){
        // foreach($datareq->groupBy(DB::Raw('month(date)'))->get() as $k => $item){
            foreach($tickettype as $j => $itemstatus){ 
                $this->datasets[$j]['label']                = ($itemstatus == '1') ? 'Hotel & Flight' : 'Hotel Only';
                $this->datasets[$j]['backgroundColor']      = $color[$j];
                $this->datasets[$j]['fill']                 = 'boundary';
                if($this->project){
                    $this->datasets[$j]['data'][]               = count(\App\Models\HotelFlightTicket::whereYear('date', $this->year)->whereMonth('date', date_format(date_create($item->date), 'm'))->where('project', $this->project)->where('ticket_type', $itemstatus)->where('status', '2')->get());
                }else{
                    $this->datasets[$j]['data'][]               = count(\App\Models\HotelFlightTicket::whereYear('date', $this->year)->whereMonth('date', date_format(date_create($item->date), 'm'))->where('ticket_type', $itemstatus)->where('status', '2')->get());
                }
                
                // $this->datasets[$j]['data'][]               = count($datareq->whereMonth('date', date_format(date_create($item->date), 'm'))->where('ticket_type', $itemstatus)->get());
                
            }
        }

        
        // foreach($tickettype as $j => $itemstatus){ 
        //     $hprice = \App\Models\HotelFlightTicket::select(DB::Raw('sum(hotel_price) as hotelprice'))->whereYear('date', $this->year)->whereMonth('date', $this->month)->where('client_project_id', $this->project)->where('ticket_type', $itemstatus)->where('status', '2')->groupBy(DB::Raw('month(date)'));
        //     $hprice = ($hprice->first()) ? $hprice->first()->hotelprice : 0;
        //     $fprice = \App\Models\HotelFlightTicket::select(DB::Raw('sum(flight_price) as flightprice'))->whereYear('date', $this->year)->whereMonth('date', $this->month)->where('client_project_id', $this->project)->where('ticket_type', $itemstatus)->where('status', '2')->groupBy(DB::Raw('month(date)'));
        //     $fprice = ($fprice->first()) ? $fprice->first()->flightprice : 0;
        //     $this->datasetsamount[$j]['label']              = ($itemstatus == '1') ? 'Hotel & Flight' : 'Hotel Only';
        //     $this->datasetsamount[$j]['backgroundColor']    = $color[$j];
        //     $this->datasetsamount[$j]['fill']               = 'boundary';
        //     $this->datasetsamount[$j]['data'][]             = $hprice + $fprice;

        // }


        foreach($labelsreq as $k => $item){
            foreach($tickettype as $j => $itemstatus){ 
                if($this->project){
                    $hprice = \App\Models\HotelFlightTicket::select(DB::Raw('sum(hotel_price) as hotelprice'))->whereYear('date', $this->year)->whereMonth('date', date_format(date_create($item->date), 'm'))->where('project', $this->project)->where('ticket_type', $itemstatus)->where('status', '2')->groupBy(DB::Raw('month(date)'));
                    $fprice = \App\Models\HotelFlightTicket::select(DB::Raw('sum(flight_price) as flightprice'))->whereYear('date', $this->year)->whereMonth('date', date_format(date_create($item->date), 'm'))->where('project', $this->project)->where('ticket_type', $itemstatus)->where('status', '2')->groupBy(DB::Raw('month(date)'));
                }else{
                    $hprice = \App\Models\HotelFlightTicket::select(DB::Raw('sum(hotel_price) as hotelprice'))->whereYear('date', $this->year)->whereMonth('date', date_format(date_create($item->date), 'm'))->where('ticket_type', $itemstatus)->where('status', '2')->groupBy(DB::Raw('month(date)'));
                    $fprice = \App\Models\HotelFlightTicket::select(DB::Raw('sum(flight_price) as flightprice'))->whereYear('date', $this->year)->whereMonth('date', date_format(date_create($item->date), 'm'))->where('ticket_type', $itemstatus)->where('status', '2')->groupBy(DB::Raw('month(date)'));
                }

                $hprice = ($hprice->first()) ? $hprice->first()->hotelprice : 0;
                $fprice = ($fprice->first()) ? $fprice->first()->flightprice : 0;
                $this->datasetsamount[$j]['label']              = ($itemstatus == '1') ? 'Hotel & Flight' : 'Hotel Only';
                $this->datasetsamount[$j]['backgroundColor']    = $color[$j];
                $this->datasetsamount[$j]['fill']               = 'boundary';
                $this->datasetsamount[$j]['data'][]             = $hprice + $fprice;

            }
        }

        if(!$this->year){
            foreach(\App\Models\HotelFlightTicket::whereYear('date', '2021')->where('status', '2')->where('ticket_type', '1')->groupBy('project')->get() as $k => $item){
                
                $this->pie1[$k]['label']  = $item->project;
                if($this->project){
                    $this->pie1[$k]['value']  = count(\App\Models\HotelFlightTicket::whereYear('date', '2021')->where('status', '2')->where('ticket_type', '1')->where('project', $item->project)->get());
                }else{
                    $this->pie1[$k]['value']  = count(\App\Models\HotelFlightTicket::whereYear('date', '2021')->where('status', '2')->where('ticket_type', '1')->get());
                }
            }
        }else{
            $this->pie2[0]['label']  = '';
            $this->pie2[0]['value']  = 0;
        }
        

        if(!$this->year){
            foreach(\App\Models\HotelFlightTicket::whereYear('date', '2021')->where('status', '2')->where('ticket_type', '2')->groupBy('project')->get() as $k => $item){
                
                $this->pie2[$k]['label']  = $item->project;
                if($this->project){
                    $this->pie2[$k]['value']  = count(\App\Models\HotelFlightTicket::whereYear('date', '2021')->where('status', '2')->where('ticket_type', '2')->where('project', $item->project)->get());
                }else{
                    $this->pie2[$k]['value']  = count(\App\Models\HotelFlightTicket::whereYear('date', '2021')->where('status', '2')->where('ticket_type', '2')->get());
                }
            }
        }else{
            $this->pie2[0]['label']  = '';
            $this->pie2[0]['value']  = 0;
        }

    
        $this->labels           = json_encode($this->labels);
        $this->datasets         = json_encode($this->datasets);
        $this->datasetsamount   = json_encode($this->datasetsamount);
        $this->pie1             = json_encode($this->pie1);
        $this->pie2             = json_encode($this->pie2);
        
        $this->emit('init-chart',['labels'=>$this->labels,'datasets'=>$this->datasets,'datasetsamount'=>$this->datasetsamount,'pie1'=>$this->pie1,'pie2'=>$this->pie2]);
    }


}



