<?php

namespace App\Http\Livewire\DutyRosterDophomebase;

use Livewire\Component;
use Livewire\WithPagination;
use Auth;
use DB;


class Data extends Component
{
    use WithPagination;
    public $date;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {  
        $data = \App\Models\DutyrosterDophomebaseMaster::orderBy('created_at', 'desc');
                                    
        if($this->date) $ata = $data->whereDate('created_at',$this->date);

        return view('livewire.duty-roster-dophomebase.data')->with(['data'=>$data->paginate(50)]);
    }
}