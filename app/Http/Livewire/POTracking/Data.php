<?php

namespace App\Http\Livewire\POTracking;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Criticalcase;


class Data extends Component
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

        // $data = Criticalcase::orderBy('id', 'DESC');
        // if($this->keyword) $ata = $data->where('name','LIKE',"{$this->keyword}");
        // if($this->pic) $ata = $data->where('pic',$this->pic);
        // if($this->region_id) $ata = $data->where('region',$this->region_id);
        
        // return view('livewire.criticalcase.data')->with(['data'=>$data->paginate(50)]);
        return view('livewire.po-tracking.data');
    }
}



