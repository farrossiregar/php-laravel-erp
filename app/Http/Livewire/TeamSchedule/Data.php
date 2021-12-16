<?php

namespace App\Http\Livewire\TeamSchedule;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PoTrackingPds;
use App\Models\PoTrackingNonms;
use Auth;
use DB;
use Session;


class Data extends Component
{
    use WithPagination;
    public $project, $filterproject, $filterweek, $filtermonth, $filteryear, $employee_name;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {

       
        $data = \App\Models\TeamScheduleNoc::where('company_name', Session::get('company_id'))->orderBy('created_at', 'desc');
            //    dd($data->get());

        // if($this->date) $ata = $data->whereDate('created_at',$this->date);
        if($this->filteryear) $ata = $data->whereYear('start_schedule',$this->filteryear);
        if($this->filtermonth) $ata = $data->whereMonth('start_schedule',$this->filtermonth);                
        if($this->filterweek) $ata = $data->where('week',$this->filterweek);                        
        if($this->filterproject) $ata = $data->where('project',$this->filterproject);                        
        
        return view('livewire.team-schedule.data')->with(['data'=>$data->paginate(50)]);

        
    }


}



