<?php

namespace App\Http\Livewire\TeamSchedule;

use Livewire\Component;
use Livewire\WithPagination;



class Datahup extends Component
{
    use WithPagination;
    public $project, $filterproject, $filterweek, $filtermonth, $filteryear, $employee_name;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {

       
        $data = \App\Models\TeamScheduleNoc::where('company_name', '1')->orderBy('created_at', 'desc');
            //    dd($data->get());

        // if($this->date) $ata = $data->whereDate('created_at',$this->date);
        if($this->filteryear) $ata = $data->whereYear('start_schedule',$this->filteryear);
        if($this->filtermonth) $ata = $data->whereMonth('start_schedule',$this->filtermonth);                
        if($this->filterweek) $ata = $data->where('week',$this->filterweek);                        
        if($this->filterproject) $ata = $data->where('project',$this->filterproject);                        
        
        return view('livewire.team-schedule.datahup')->with(['data'=>$data->paginate(50)]);

        
    }


}



