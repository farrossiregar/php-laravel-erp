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
    // public $keyword,$region_id;
    // use WithPagination;
    // protected $paginationTheme = 'bootstrap';
    // protected $listeners = ['emit-delete-hide' => '$refresh'];
    public function render()
    {
        $month = '12';
        $year = '2021';
        $data = SiteListTrackingDetail::select(DB::Raw('sum(qty_po) as QTY'))->
                                        whereIn('period', ['2021-12', '2021-11'])->
                                        
                                        // whereIn('region', ['Sumatera', 'West Java'])->
                                        where('region', 'Sumatera')->
                                        groupBy('period')->
                                        get();
        
        
        $datamonth = SiteListTrackingDetail::select(DB::Raw('substring(period, 6, 2) as month'))->
                                        whereIn('period', ['2021-12', '2021-11'])->
                                        
                                        // whereIn('region', ['Sumatera', 'West Java'])->
                                        where('region', 'Sumatera')->
                                        groupBy('period')->
                                        get();
        // dd(json_decode($data));
        return view('livewire.sitetracking.dashboard')->with(compact('data', 'datamonth'));
    }
}
