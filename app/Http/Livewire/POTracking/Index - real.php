<?php

namespace App\Http\Livewire\PoTracking;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PoTrackingPds;
use App\Models\PoTrackingReimbursementMaster;
use Auth;


class Index extends Component
{
    public $date;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        // if(!check_access('po-tracking.index')){
        //     session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
        //     $this->redirect('/');
        // }

        $data = PoTrackingReimbursementMaster::orderBy('id', 'DESC');
        if($this->date) $ata = $data->whereDate('created_at',$this->date);

        return view('livewire.po-tracking.index')->with(['data'=>$data->paginate(50)]);
        
    }


    // public function save(){
    //     $potrackingpds = new PoTrackingPds();
    //     $potrackingpds->project_name                           = 'test';
    //     $potrackingpds->created_at                             = date('Y-m-d H:i:s');
    //     $potrackingpds->updated_at                             = date('Y-m-d H:i:s');
    //     $potrackingpds->save();
    // }
}



