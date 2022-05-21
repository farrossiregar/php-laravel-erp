<?php

namespace App\Http\Livewire\RequestDetailOption;

use Livewire\Component;
use Livewire\WithPagination;
use Session;
use DB;


class Data extends Component
{
    use WithPagination;
    public $project, $date, $filterproject, $employee_name;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        $data = \App\Models\RequestDetailOption::orderBy('created_at', 'desc');
        
        // if($this->filteryear) $data->whereYear('date',$this->filteryear);
        // if($this->filtermonth) $data->whereMonth('date',$this->filtermonth);                
        
        // if($this->date) $data->where(DB::Raw('date(created_at)'),$this->date);                        
        // if($this->filterproject) $data->where('client_project_id',$this->filterproject);                        
        
        return view('livewire.request-detail-option.data')->with(['data'=>$data->paginate(50)]);   
    }
}