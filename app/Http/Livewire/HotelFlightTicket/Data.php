<?php

namespace App\Http\Livewire\HotelFlightTicket;

use Livewire\Component;
use Livewire\WithPagination;
use Session;


class Data extends Component
{
    use WithPagination;
    public $project, $filterproject, $filterweek, $filtermonth, $filteryear, $employee_name;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        $data = \App\Models\TeamScheduleNoc::where('company_name', Session::get('company_id'))->orderBy('created_at', 'desc');
        
        if($this->filteryear) $data->whereYear('start_schedule',$this->filteryear);
        if($this->filtermonth) $data->whereMonth('start_schedule',$this->filtermonth);                
        if($this->filterweek) $data->where('week',$this->filterweek);                        
        if($this->filterproject) $data->where('project',$this->filterproject);                        
        
        return view('livewire.hotel-flight-ticket.data')->with(['data'=>$data->paginate(50)]);   
    }
}