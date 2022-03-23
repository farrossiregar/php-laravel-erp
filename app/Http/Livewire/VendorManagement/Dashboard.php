<?php

namespace App\Http\Livewire\VendorManagement;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Criticalcase;

use App\Helpers\GeneralHelper;
use DB;


class Dashboard extends Component
{
    public $start,$end,$year,$datasets,$month;
    public $sales_name;
    public $labels;
    public $labels2, $datasets2;
    //public $series;
    //public $seriess;
    // public $project;
    // public $region;
    public function render()
    { 
       

        // $labels = $this->labels;
        // $series = $this->series;
        
        $this->generate_chart();  
        return view('livewire.vendor-management.dashboard');
    }

    // ketika ada filter / perubahan di form maka di generate ulang chart berdasarkan data yang dirubah di formnya
    public function updated()
    {
        $this->generate_chart();
    }
    // set default ketika pertama kali load halaman
    public function mount(){
        $this->year = date('Y'); 
        $this->generate_chart();
    }

    public function generate_chart(){
        $this->labels = [];
        $this->datasets = [];
        $this->labels2 = [];
        $this->datasets2 = [];

    
        $rate = \App\Models\BusinessOpportunities::where('status', '1')->where('sales_name', $this->sales_name)->get();
        $won = \App\Models\BusinessOpportunities::where('status', '1')->where('sales_name', $this->sales_name)->get();
        $all = \App\Models\BusinessOpportunities::orderBy('id', 'desc')->where('sales_name', $this->sales_name)->get();


        
        // $this->labels = array('Hit Rate (%)', 'Won', 'Leads');

        $this->datasets[0]['label'] = 'Hit Rate (%)';
        $this->datasets[0]['backgroundColor'] = sprintf('#%06X', mt_rand(0, 0xFFFFFF)); // generate warna
        $this->datasets[0]['fill'] = 'boundary';
        // $this->datasets[0]['borderColor'] = sprintf('#%06X', mt_rand(0, 0xFFFFFF)); // generate warna
        // $this->datasets[0]['borderWidth'] = 1;
        // $this->datasets[0]['data'][] = 55;
        
        if(count($all) < 1){
            $this->datasets[0]['data'][] = 0;
        }else{
            $this->datasets[0]['data'][] = ( count(@$rate) / count(@$all) ) * 100;
        }
        

        $this->datasets[1]['label'] = 'Won';
        $this->datasets[1]['backgroundColor'] = sprintf('#%06X', mt_rand(0, 0xFFFFFF)); // generate warna
        $this->datasets[0]['fill'] = 'boundary';
        // $this->datasets[1]['borderColor'] = sprintf('#%06X', mt_rand(0, 0xFFFFFF)); // generate warna
        // $this->datasets[1]['borderWidth'] = 1;
        $this->datasets[1]['data'][] = count($won);

        $this->datasets[2]['label'] = 'Leads';
        $this->datasets[2]['backgroundColor'] = sprintf('#%06X', mt_rand(0, 0xFFFFFF)); // generate warna
        $this->datasets[0]['fill'] = 'boundary';
        // $this->datasets[2]['borderColor'] = sprintf('#%06X', mt_rand(0, 0xFFFFFF)); // generate warna
        // $this->datasets[2]['borderWidth'] = 1;
        $this->datasets[2]['data'][] = count($all);

        // $this->datasets[] = [];
        // $this->datasets[0]['data'] = array('55', '11', '20');


        $tower = \App\Models\BusinessOpportunities::where('customer_type', 'Tower provider')->where('status', '1')->where('sales_name', $this->sales_name)->get();
        $vendor = \App\Models\BusinessOpportunities::where('customer_type', 'Vendor')->where('status', '1')->where('sales_name', $this->sales_name)->get();
        $operators = \App\Models\BusinessOpportunities::where('customer_type', 'Operators')->where('status', '1')->where('sales_name', $this->sales_name)->get();
        $others = \App\Models\BusinessOpportunities::where('customer_type', 'Others')->where('status', '1')->where('sales_name', $this->sales_name)->get();

        $this->labels2 = array('Tower provider', 'Vendor', 'Operators', 'Others');

        $this->datasets2[0]['label'][] = array('Tower Provider', 'Vendor', 'Operators', 'Others');
        $this->datasets2[0]['backgroundColor'] = array(sprintf('#%06X', mt_rand(0, 0xFFFFFF)), sprintf('#%06X', mt_rand(0, 0xFFFFFF)), sprintf('#%06X', mt_rand(0, 0xFFFFFF)), sprintf('#%06X', mt_rand(0, 0xFFFFFF))); // generate warna
        $this->datasets2[0]['fill'] = 'boundary';
        // $this->datasets2[0]['data'][] = count($tower);
        $this->datasets2[0]['data'] = array(count($tower), count($vendor), count($operators), count($others));

        // $this->datasets2[1]['label'] = 'Vendor';
        // $this->datasets2[1]['backgroundColor'] = sprintf('#%06X', mt_rand(0, 0xFFFFFF)); // generate warna
        // $this->datasets2[1]['fill'] = 'boundary';
        // $this->datasets2[1]['data'][] = count($vendor);

        // $this->datasets2[2]['label'] = 'Operators';
        // $this->datasets2[2]['backgroundColor'] = sprintf('#%06X', mt_rand(0, 0xFFFFFF)); // generate warna
        // $this->datasets2[2]['fill'] = 'boundary';
        // $this->datasets2[2]['data'][] = count($operators);

        // $this->datasets2[3]['label'] = 'Others';
        // $this->datasets2[3]['backgroundColor'] = sprintf('#%06X', mt_rand(0, 0xFFFFFF)); // generate warna
        // $this->datasets2[3]['fill'] = 'boundary';
        // $this->datasets2[3]['data'][] = count($others);
        
        $this->labels = json_encode($this->labels); 
        $this->datasets = json_encode($this->datasets); 
        $this->labels2 = json_encode($this->labels2); 
        $this->datasets2 = json_encode($this->datasets2); 
        // dd(json_encode($this->datasets2));
        
        
        $this->emit('init-chart',['labels'=>$this->labels,'datasets'=>$this->datasets,'labels2'=>$this->labels2,'datasets2'=>$this->datasets2]);
    }
}
