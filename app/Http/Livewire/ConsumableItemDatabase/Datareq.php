<?php

namespace App\Http\Livewire\ConsumableItemDatabase;

use Livewire\Component;
use Livewire\WithPagination;
use Session;
use DB;


class Datareq extends Component
{
    use WithPagination;
    public $project, $date, $region, $category, $employee_name;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        $data = \App\Models\ConsumableItemRequest::orderBy('created_at', 'desc');
                     
        
        if($this->date) $data->where(DB::Raw('date(created_at)'),$this->date);                                       
        if($this->category) $data->where('item_category',$this->category);                      
        
        return view('livewire.consumable-item-database.datareq')->with(['data'=>$data->paginate(50)]);   
    }
}