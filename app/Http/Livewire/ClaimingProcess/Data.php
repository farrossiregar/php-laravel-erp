<?php

namespace App\Http\Livewire\ClaimingProcess;

use Livewire\Component;
use Livewire\WithPagination;
use Session;
use DB;


class Data extends Component
{
    use WithPagination;
    public $project, $date, $name;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        $data = \App\Models\HotelFlightTicket::where('company_name', Session::get('company_id'))->where('status', '2')->orderBy('created_at', 'desc');
        
        // if($this->filteryear) $data->whereYear('date',$this->filteryear);
        // if($this->filtermonth) $data->whereMonth('date',$this->filtermonth);                
        
        if($this->date) $data->where(DB::Raw('date(created_at)'),$this->date);                        
        if($this->project) $data->where('project',$this->project);                        
        if($this->name) $data->where('name',$this->name);                        
        
        return view('livewire.claiming-process.data')->with(['data'=>$data->paginate(50)]);   
    }
}