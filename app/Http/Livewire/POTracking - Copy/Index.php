<?php

namespace App\Http\Livewire\POTracking;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PoTrackingPds;


class Index extends Component
{
    public $keyword,$region_id,$pic;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        if(!check_access('po-tracking.index')){
            session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
            $this->redirect('/');
        }

        $data = PoTrackingPds::orderBy('id', 'DESC');
        // if($this->keyword) $ata = $data->where('name','LIKE',"{$this->keyword}");
        // if($this->pic) $ata = $data->where('pic',$this->pic);
        // if($this->region_id) $ata = $data->where('region',$this->region_id);


        return view('livewire.po-tracking.index')->with(['data'=>$data->paginate(50)]);
        
    }


    public function save(){
        $potrackingpds = new PoTrackingPds();
        $potrackingpds->project_name                           = 'test';
        $potrackingpds->created_at                             = date('Y-m-d H:i:s');
        $potrackingpds->updated_at                             = date('Y-m-d H:i:s');
        $potrackingpds->save();
    }
}



