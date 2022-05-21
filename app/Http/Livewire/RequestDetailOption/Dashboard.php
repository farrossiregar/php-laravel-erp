<?php

namespace App\Http\Livewire\RequestDetailOption;

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
    protected $paginationTheme = 'bootstrap';

    public function render()
    {

       
        $this->dataproject = [];

        if($this->region){
            
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

        if($this->month){
            $this->month = $this->month;
        }else{
            $this->month = date('m');
        }

        if($this->region){
            $getregion = \App\Models\Region::where('id', $this->region)->first()->region_code;
            
        }else{
            $getregion = '';
        }

        $color = ['#ffb1c1','#4b89d6', '#007bff','#28a745','#333333'];
        
        $tickettype = ['1', '2'];
        $reqstatus = ['open', 'reject', 'close'];
        
        
       
        $monthdata = \App\Models\AssetRequest::whereYear('created_at',$this->year)->where('project', $this->project)->where('region', $getregion)->whereMonth('created_at', $this->month);
        foreach($monthdata->groupBy(DB::Raw('month(created_at)'))->get() as $k => $item){
            $this->labels[$k] = date_format(date_create($item->created_at), 'M');
        }
       
        $open = count(\App\Models\AssetRequest::whereYear('created_at',$this->year)->where('project', $this->project)->where('region', $getregion)->whereMonth('created_at', $this->month)->whereNull('status')->get());
        $reject = count(\App\Models\AssetRequest::whereYear('created_at',$this->year)->where('project', $this->project)->where('region', $getregion)->whereMonth('created_at', $this->month)->where('status', '0')->get());
        $close = count(\App\Models\AssetRequest::whereYear('created_at',$this->year)->where('project', $this->project)->where('region', $getregion)->whereMonth('created_at', $this->month)->where('status', '1')->get());

        $reqstatus2 = [$open, $reject, $close];
     
        
        foreach($reqstatus as $k => $status){ 
        
            $this->datasets[$k]['label']                = $status;
            $this->datasets[$k]['backgroundColor']      = $color[$k];
            $this->datasets[$k]['fill']                 = 'boundary';
            
            $this->datasets[$k]['data'][]               = $reqstatus2[$k];
        }

            
        
    
        $this->labels = json_encode($this->labels);
        $this->datasets = json_encode($this->datasets);

        $countaging = 0;

        $aging =  \App\Models\AssetRequest::orderBy('id', 'desc')->whereNull('status');
        if($this->project){
            $aging = $aging->where('project', $this->project)->where('region', $getregion)->get();
        }else{
            $aging = $aging->get();
        }

        
        foreach($aging as $k => $item){

            if($item->updated_at == $item->created_at){
                // $diff    = abs(strtotime(date_format(date_create(date('Y-m-d H:i:s')), 'Y-m-d H:i:s')) - strtotime(date_format(date_create($item->created_at), 'Y-m-d H:i:s')));
                $diff    = abs(strtotime(date('Y-m-d H:i:s')) - strtotime(date_format(date_create($item->created_at), 'Y-m-d H:i:s')));
                $years   = floor($diff / (365*60*60*24)); 
                $months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
                $days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                $hours   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60)); 
                $minuts  = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60); 
        
                if($days >= 14){
                    $countaging = $countaging + 1;
                }

            }
        }


        $this->aging = $countaging;
        

        $this->emit('init-chart',['labels'=>$this->labels,'datasets'=>$this->datasets,'aging'=>$this->aging]);
    }


}



