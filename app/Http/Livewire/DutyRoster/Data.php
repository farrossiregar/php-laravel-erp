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
    public $date, $month, $year;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {

       
        $data = \App\Models\EmployeeNoc::orderBy('month')->orderBy('year');
                                    
        
        // if($this->date) $ata = $data->where('month',date_format(date_create($this->date), 'm'))
        //                             ->where('year',date_format(date_create($this->date), 'Y'));

        if($this->date) $ata = $data->where('month',$this->month)
                                    ->where('year',$this->year);
                        
        
        return view('livewire.duty-roster.data')->with(['data'=>$data->paginate(50)]);

        
    }


}



