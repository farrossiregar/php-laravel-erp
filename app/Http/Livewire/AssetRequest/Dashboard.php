<?php

namespace App\Http\Livewire\AssetRequest;

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
    protected $paginationTheme = 'bootstrap';

    public function render()
    {

        // $getproject = \App\Models\ClientProject::where('id', $this->project)
        //         ->where('company_id', Session::get('company_id'))
        //         ->where('is_project', '1')
        //         ->first();

        // if($getproject){
        //     if($getproject->region_id){
        //         $this->region = \App\Models\Region::where('id', $getproject->region_id)->first()->region_code;
        //     }else{
        //         $this->region = '';
        //     }
        // }else{
        //     $this->region = '';
        // }
        $this->dataproject = [];

        if($this->region){
            // dd($this->region);
            $this->dataproject = \App\Models\ClientProject::orderBy('id', 'desc')
                                ->where('region_id', $this->region)
                                ->where('company_id', Session::get('company_id'))
                                ->where('is_project', '1')
                                ->get();
        }

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
        $this->mo = [];

        if($this->year){
            $this->year = $this->year;
        }else{
            $this->year = date('Y');
        }

        // if($this->month){
        //     $this->month = $this->month;
        // }else{
        //     $this->month = date('m');
        // }

        if($this->region){
            $getregion = \App\Models\Region::where('id', $this->region)->first()->region_code;
            // dd($this->region);
        }else{
            $getregion = '';
        }

        $color = ['#ffb1c1','#4b89d6', '#007bff','#28a745','#333333'];
        
        $tickettype = ['1', '2'];
        $reqstatus = ['open', 'reject', 'close'];
        
       
        // foreach(\App\Models\HotelFlightTicket::whereYear('date',$this->year)->whereMonth('date', $this->month)->where('project', $this->project)->where('status', '2')->get() as $k => $item){
        //     $this->labels[$k] = date('F', mktime(0, 0, 0, (int)$item->month, 10));
        // }

        $monthdata = \App\Models\AssetRequest::whereYear('created_at',$this->year)->where('project', $this->project)->where('region', $getregion);
        foreach($monthdata->groupBy(DB::Raw('month(created_at)'))->get() as $k => $item){
            // $this->labels[$k] = date('F', mktime(0, 0, 0, (int)$item->month, 10));
            $this->labels[$k] = date_format(date_create($item->created_at), 'M');
        }
       
        
        foreach($monthdata->groupBy(DB::Raw('month(created_at)'))->get() as $j => $itemstatus){ 
            // $this->mo[$j] = date_format(date_create($itemstatus->created_at), 'm');
            // $this->datasets = [];
            foreach($reqstatus as $k => $status){ 
                // $this->mo[$j][$k] = date_format(date_create($itemstatus->created_at), 'm').' - '.$status;
                // $this->datasets[$j]['label']                = $status;
                
                // $this->datasets[$j]['backgroundColor']      = $color[$j];
                // $this->datasets[$j]['fill']                 = 'boundary';
                // $this->datasets[$j]['data'][]               = count($monthdata->where('status', '1')->get());

                // $this->datasets[$k]['label']                = $status.' - '.date_format(date_create($itemstatus->created_at), 'm');
                $this->datasets[$k]['label']                = $status;
                $this->datasets[$k]['backgroundColor']      = $color[$k];
                $this->datasets[$k]['fill']                 = 'boundary';
                // if($status == 'open'){
                //     $this->datasets[$k]['data'][]               = count($monthdata->whereMonth('created_at', date_format(date_create($itemstatus->created_at), 'm'))->whereNull('status')->get());
                // }elseif($status == 'reject'){
                //     $this->datasets[$k]['data'][]               = count($monthdata->whereMonth('created_at', date_format(date_create($itemstatus->created_at), 'm'))->where('status', '0')->get());
                // }else{
                //     $this->datasets[$k]['data'][]               = count($monthdata->whereMonth('created_at', date_format(date_create($itemstatus->created_at), 'm'))->where('status', '1')->get());
                // }
                $this->datasets[$k]['data'][]               = count($monthdata->whereMonth('created_at', date_format(date_create($itemstatus->created_at), 'm'))->where('status', '1')->get());
            }

            
        }
        // if($this->year && $this->project && $this->region){
        //     dd($this->datasets);
        // }

        // dd($reqstatus);
        if($this->year && $this->project && $this->region){
            // dd($this->mo);
        }

        // dd(\App\Models\AssetRequest::whereYear('created_at','2021')->where('project', 'STP MS Project')->where('region', 'Jabo 2')->whereNull('status')->get());


        
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



