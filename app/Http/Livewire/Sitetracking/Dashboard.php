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
    public $month = [];
    // use WithPagination;
    // protected $paginationTheme = 'bootstrap';
    // protected $listeners = ['emit-delete-hide' => '$refresh'];


    public function render(){

        return view('livewire.sitetracking.dashboard');
    }


    public function mount(){
       
    }

    public function generate_chart(){
        $data = SiteListTrackingDetail::
        select(DB::Raw('sum(site_list_tracking_detail.qty_po) as QTY'), 'site_list_tracking_detail.period')->
        leftJoin('site_list_tracking_master', 'site_list_tracking_detail.id_site_master', '=', 'site_list_tracking_master.id')->
        
        where('site_list_tracking_master.status', '1')->
        whereIn('site_list_tracking_detail.region', ['Sumatera', 'Central Java']);
       
        $mt = array();
        if($this->year != '' && $this->month != ''){

            for($i = 0; $i < count($month); $i++){
                array_push($mt, $year.'-'.$month[$i]);
            }
        $ata = $data->whereIn('site_list_tracking_detail.period', $mt);
        }

        $data = $data->groupBy('site_list_tracking_detail.period')->
        groupBy('site_list_tracking_detail.region')->
        orderBy('site_list_tracking_detail.period', 'ASC')->get();
    }


}
