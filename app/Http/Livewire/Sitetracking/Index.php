<?php

namespace App\Http\Livewire\Sitetracking;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SiteListTrackingMaster;
// use App\Models\SiteListTrackingDetail;
// use App\Models\SiteListTrackingTemp;
// use App\Helpers\GeneralHelper;


class Index extends Component
{
    // public $keyword,$region_id;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    // protected $listeners = ['emit-delete-hide' => '$refresh'];
    public function render()
    {
        $data = SiteListTrackingMaster::orderBy('id', 'DESC');
        if(check_access_controller('site-tracking.index') == true){
            session()->flash('message-error','Access denied.');
            $this->redirect('/');
        }

       

        return view('livewire.sitetracking.index')->with(['data'=>$data->paginate(100)]);
    }
}



