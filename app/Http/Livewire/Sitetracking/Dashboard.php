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
    public $year,$region_id;
    public $month = [];
    // use WithPagination;
    // protected $paginationTheme = 'bootstrap';
    // protected $listeners = ['emit-delete-hide' => '$refresh'];
    public function render()
    {
        
        
        if($this->year){
            $year = $this->year;
        }else{
            $year = date('Y');
        }

        $data = SiteListTrackingDetail::
                                        // select('qty_po')->
                                        select(DB::Raw('sum(site_list_tracking_detail.qty_po) as QTY'))->
                                        leftJoin('site_list_tracking_master', 'site_list_tracking_detail.id_site_master', '=', 'site_list_tracking_master.id')->
                                        whereIn('site_list_tracking_detail.period', [$year.'-12', $year.'-11'])->
                                        where('site_list_tracking_detail.id_site_master', '1')->
                                        whereIn('site_list_tracking_detail.region', ['Sumatera', 'Central Java'])->
                                        // where('region', 'sumatera')->
                                        // groupBy(DB::Raw('substring(period, 5, 2)'));
                                        groupBy('site_list_tracking_detail.period')->
                                        groupBy('site_list_tracking_detail.region')->
                                        orderBy('site_list_tracking_detail.id', 'ASC');
                                        
                                            
                                        
        // if($this->year) $ata = $data->where('name','LIKE',"{$this->year}");
        
        // if($this->region_id){
        //     $region = App\Models\Region::select('region')->where('id', $this->region_id)->get();
        //     $data = $data->where('region',$region);
        // }

        $data = $data->get();
        // dd(json_decode($data));
        
        $datamonth = SiteListTrackingDetail::select(DB::Raw('substring(period, 6, 2) as month'))->
                                        whereIn('period', ['2021-12', '2021-11'])->
                                        
                                        // whereIn('region', ['Sumatera', 'West Java'])->
                                        where('region', 'Sumatera')->
                                        groupBy('period')->
                                        get();
        $months = $this->month;
        // dd($months);
        return view('livewire.sitetracking.dashboard')->with(compact('data', 'datamonth', 'months'));
    }
}
