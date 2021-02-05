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
    public $series;
    // protected $listeners = ['emit-delete-hide' => '$refresh'];


    public function render(){
        $this->generate_chart();
        return view('livewire.sitetracking.dashboard');
    }


    public function mount(){
       
    }

    public function generate_chart(){
        $this->labels = [];
        $this->series = [];


        $year = '2021';
        $month = ['01', '11', '12'];

        $mt = array();
        if($year != '' && $month != ''){

            for($i = 0; $i < count($month); $i++){
                array_push($mt, $year.'-'.$month[$i]);
            }
        }


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

        foreach(SiteListTrackingDetail::whereIn('region', ['Sumatera', 'Central Java'])->
                    // whereIn('period', $mt)->
                    whereIn('period', ['2021-11', '2021-12'])->
                    groupBy('period')
                    ->orderBy('period', 'ASC')->select('period')->get() as $k => $items){
                        $period[$k] = $items->period;   
                        foreach(SiteListTrackingDetail::whereIn('region', ['Sumatera', 'Central Java'])->
                                    where('period', $period[$k])->
                                    groupBy('period')->
                                    groupBy('region')->
                                    orderBy('period', 'ASC')->
                                    select(DB::Raw('sum(site_list_tracking_detail.qty_po) as jumlah'), 'region')->get() as $j => $item){
                                        // $this->series[] = $item->jumlah.' - '.$items->period.' - '.$item->region;
                                        // $jmlh[$j] = $item->jumlah.' - '.$items->period.' - '.$item->region;
                                        $jmlh[$j] = $item->jumlah;

                        }
                $this->series[] = $jmlh;

        }

        // dd(json_encode($this->series));

        
        // dd($mt);
        foreach(SiteListTrackingDetail::whereIn('region', ['Sumatera', 'Central Java'])->
                    // whereIn('period', ['2021-11', '2021-12'])->
                    whereIn('period', $mt)->
                    groupBy('period')->orderBy('period', 'ASC')->select('period')->get() as $item){
                        $this->labels[] = $item->period;

        }

        // dd($this->labels);


        $this->labels = $this->labels;
        $this->series = $this->series;
        
        
        $this->emit('init-chart',['labels'=>$this->labels,'series'=>$this->series]);
    }


}
