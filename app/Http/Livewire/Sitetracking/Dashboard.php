<?php

namespace App\Http\Livewire\Sitetracking;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SiteListTrackingMaster;
use App\Models\SiteListTrackingDetail;
use App\Models\SiteListTrackingTemp;
use App\Helpers\GeneralHelper;
use DB;

class Dashboard extends Component
{
    public $year;
    public $month;
    public $labels;
    public $datasets;
    public function render()
    {
        $this->generate_chart();
        return view('livewire.sitetracking.dashboard');
    }
    public function updated($propertyName)
    {
        if($propertyName=='year') $this->month = '';
        $this->generate_chart();
    }
    public function generate_chart(){
        $this->labels = [];
        $this->datasets = [];
        // $year = '2021';
        // $month = ['01', '11', '12'];

        // $mt = array();
        // if($year != '' && $month != ''){

        //     for($i = 0; $i < count($month); $i++){
        //         array_push($mt, $year.'-'.$month[$i]);
        //     }
        // }
        // $data = SiteListTrackingDetail::
        // select(DB::Raw('sum(site_list_tracking_detail.qty_po) as QTY'), 'site_list_tracking_detail.period')->
        // leftJoin('site_list_tracking_master', 'site_list_tracking_detail.id_site_master', '=', 'site_list_tracking_master.id')->
        
        // where('site_list_tracking_master.status', '1')->
        // whereIn('site_list_tracking_detail.region', ['Sumatera', 'Central Java']);
       
        // $mt = array();
        // if($this->year != '' && $this->month != ''){

        //     for($i = 0; $i < count($month); $i++){
        //         array_push($mt, $year.'-'.$month[$i]);
        //     }
        // $ata = $data->whereIn('site_list_tracking_detail.period', $mt);
        // }

        // $data = $data->groupBy('site_list_tracking_detail.period')->
        // groupBy('site_list_tracking_detail.region')->
        // orderBy('site_list_tracking_detail.period', 'ASC')->get();
        // foreach(SiteListTrackingDetail::whereIn('region', ['Sumatera', 'Central Java'])->
        //             whereIn('period', ['2021-11', '2021-12'])->
        //             groupBy('period')->orderBy('period', 'ASC')->
        //             select(DB::Raw('sum(site_list_tracking_detail.qty_po) as jumlah'))->get() as $item){
        //                 $this->series[] = $item->jumlah;

        // }

        // foreach(SiteListTrackingDetail::whereIn('region', ['Sumatera', 'Central Java'])->
        //             // whereIn('period', $mt)->
        //             whereIn('period', ['2021-11', '2021-12'])->
        //             groupBy('period')
        //             ->orderBy('period', 'ASC')->select('period')->get() as $k => $items){
        //                 $period[$k] = $items->period;   
        //                 foreach(SiteListTrackingDetail::whereIn('region', ['Sumatera', 'Central Java'])->
        //                             where('period', $period[$k])->
        //                             groupBy('period')->
        //                             groupBy('region')->
        //                             orderBy('period', 'ASC')->
        //                             select(DB::Raw('sum(site_list_tracking_detail.qty_po) as jumlah'), 'region')->get() as $j => $item){
        //                                 // $this->series[] = $item->jumlah.' - '.$items->period.' - '.$item->region;
        //                                 // $jmlh[$j] = $item->jumlah.' - '.$items->period.' - '.$item->region;
        //                                 $jmlh[$j] = $item->jumlah;

        //                 }
        //         $this->series[] = $jmlh;

        // }

        // // dd(json_encode($this->series));

        
        // // dd($mt);
        // foreach(SiteListTrackingDetail::whereIn('region', ['Sumatera', 'Central Java'])->
        //             // whereIn('period', ['2021-11', '2021-12'])->
        //             whereIn('period', $mt)->
        //             groupBy('period')->orderBy('period', 'ASC')->select('period')->get() as $item){
        //                 $this->labels[] = $item->period;

        // }

        foreach(SiteListTrackingDetail::select(\DB::raw("MONTH(period) as month"))->where(function($table){ 
            if($this->year) $table->whereYear('period',$this->year); 
        })->groupBy('month')->get() as $k => $item){
            $this->labels[] = date('F', mktime(0, 0, 0, $item->month, 10));
        }
        $color = ['#ffb1c1','#4b89d6','#add64b','#80b10a'];
        foreach(SiteListTrackingDetail::where(function($table){
            if($this->year)$table->whereYear('period',$this->year);
        })->groupBy('region1')->get() as $k => $item){
            $this->datasets[$k]['label'] = $item->region1;
            // $this->datasets[$k]['borderColor'] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            $this->datasets[$k]['backgroundColor']= @$color[$k];//sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            $this->datasets[$k]['fill'] =  'boundary';
            $this->datasets[$k]['data'] = [];
            foreach(SiteListTrackingDetail::select(\DB::raw("MONTH(period) as month"),'region1')->where('region1',$item->region1)->where(function($table){
                if($this->year) $table->whereYear('period',$this->year); 
            })->groupBy('month')->get() as $k_data => $data){
                $this->datasets[$k]['data'][] = SiteListTrackingDetail::where(function($table){
                    if($this->year) $table->whereYear('period',$this->year); 
                })->whereMonth('period',$data->month)->where('region1',$data->region1)->sum('actual_qty');
            }
        }

        $this->labels = json_encode($this->labels);
        $this->datasets = json_encode($this->datasets);
        
        $this->emit('init-chart',['labels'=>$this->labels,'datasets'=>$this->datasets]);
    }


}
