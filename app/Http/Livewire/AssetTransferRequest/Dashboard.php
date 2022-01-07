<?php

namespace App\Http\Livewire\AssetTransferRequest;

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

        $this->dataproject = [];

        if($this->region){
            $this->dataproject = \App\Models\ClientProject::orderBy('id', 'desc')
                                ->where('region_id', $this->region)
                                ->where('company_id', Session::get('company_id'))
                                ->where('is_project', '1')
                                ->get();
        }

        $this->generate_chart();
        return view('livewire.asset-transfer-request.dashboard');
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
        
        $reqstatus = ['Total Request', 'Open Request'];

        
        $monthdata = \App\Models\AssetTransferRequest::
                                                where('company_name', Session::get('company_id'))
                                                ->whereYear('created_at',$this->year)
                                                ->whereMonth('created_at', $this->month)
                                                ->where('project', $this->project)
                                                ->where('region', $getregion);
                                                
        foreach($monthdata->groupBy(DB::Raw('month(asset_transfer_request.created_at)'))->get() as $k => $item){
            $this->labels[$k] = date_format(date_create($item->created_at), 'M');
        }
       
        $total_req   = count(\App\Models\AssetTransferRequest::where('company_name', Session::get('company_id'))->whereYear('created_at',$this->year)->where('project', $this->project)->where('region', $getregion)->whereMonth('created_at', $this->month)->get());
        $open_req   = count(\App\Models\AssetTransferRequest::where('company_name', Session::get('company_id'))->whereYear('created_at',$this->year)->where('project', $this->project)->where('region', $getregion)->whereMonth('created_at', $this->month)->whereNull('status')->get()) + count(\App\Models\AssetTransferRequest::where('company_name', Session::get('company_id'))->whereYear('created_at',$this->year)->where('project', $this->project)->where('region', $getregion)->whereMonth('created_at', $this->month)->where('status', '1')->get());

        $reqstatus2 = [$total_req, $open_req];
        
        foreach($reqstatus as $k => $status){ 
        
            $this->datasets[$k]['label']                = $status;
            $this->datasets[$k]['backgroundColor']      = $color[$k];
            $this->datasets[$k]['fill']                 = 'boundary';
            $this->datasets[$k]['data'][]               = $reqstatus2[$k];
        }

        $this->labels = json_encode($this->labels);
        $this->datasets = json_encode($this->datasets);
        
        $this->emit('init-chart',['labels'=>$this->labels,'datasets'=>$this->datasets]);
    }


}



