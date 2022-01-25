<?php

namespace App\Http\Livewire\HrgaPettyCash;

use Livewire\Component;
use Livewire\WithPagination;
use Session;
use DB;


class Data extends Component
{
    use WithPagination;
    public $project, $date, $region, $category, $employee_name;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        $data = \App\Models\HrgaPettyCash::orderBy('created_at', 'desc');
        
        // if($this->filteryear) $data->whereYear('date',$this->filteryear);
        // if($this->filtermonth) $data->whereMonth('date',$this->filtermonth);                
        
        // if($this->date) $data->where(DB::Raw('date(created_at)'),$this->date);                        
        // if($this->project) $data->where('project',$this->project);                        
        // if($this->category) $data->where('asset_type',$this->category);                        
        // if($this->region) $data->where('region',$this->region);                        
        
        return view('livewire.hrga-petty-cash.data')->with(['data'=>$data->paginate(50)]);   
    }
}