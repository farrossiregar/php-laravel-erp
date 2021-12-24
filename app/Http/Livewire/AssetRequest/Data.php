<?php

namespace App\Http\Livewire\AssetRequest;

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
        $data = \App\Models\AssetRequest::where('company_name', Session::get('company_id'))->orderBy('created_at', 'desc');
        
        if($this->filteryear) $data->whereYear('date',$this->filteryear);
        if($this->filtermonth) $data->whereMonth('date',$this->filtermonth);                
        
        if($this->filterproject) $data->where('client_project_id',$this->filterproject);                        
        
        return view('livewire.asset-request.data')->with(['data'=>$data->paginate(50)]);   
    }
}