<?php

namespace App\Http\Livewire\Sitetracking;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SiteListTrackingMaster;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $project_id;
    protected $queryString = ['project_id'];
    public function render()
    {
        $data = SiteListTrackingMaster::orderBy('id', 'DESC');
        if(check_access_controller('site-tracking.index') == false){
            session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
            $this->redirect('/');
        }

        return view('livewire.sitetracking.index')->with(['data'=>$data->paginate(100)]);
    }

    public function mount()
    {
        if(isset($this->project_id)) session()->put('project_id',$this->project_id);
        \LogActivity::add('[web] Site Tracking');
    }
}