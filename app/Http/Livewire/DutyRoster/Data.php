<?php

namespace App\Http\Livewire\DutyRoster;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PoTrackingPds;
use App\Models\PoTrackingNonms;
use Auth;
use DB;


class Data extends Component
{
    use WithPagination;
    public $date;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {  
        $data = \App\Models\DutyrosterSitelistMaster::orderBy('created_at', 'desc');
                                    
        if($this->date) $ata = $data->whereDate('created_at',$this->date);                       
        
        return view('livewire.duty-roster.data')->with(['data'=>$data->paginate(50)]);
    }
}