<?php

namespace App\Http\Livewire\DutyRosterFlmengineer;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PoTrackingPds;
use App\Models\PoTrackingNonms;
use Auth;
use DB;


class Data extends Component
{
    use WithPagination;
    public $date, $data;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {

       
        $data = check_access_data('duty-roster-flmengineer.flmengineer-list', '');
        // dd($data);
        // foreach($data as $k => $item){
        //     dd($item[$k]);
        // }
        // $data1 = \App\Models\EmployeeNoc::get();
        // dd($data, $data1);

        // if($this->date) $ata = $data->whereDate('created_at',$this->date);
                        
        
        // return view('livewire.duty-roster-flmengineer.data')->with(['data'=>$data->paginate(50)]);
        return view('livewire.duty-roster-flmengineer.data');

        
    }


}



