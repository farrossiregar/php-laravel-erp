<?php

namespace App\Http\Livewire\BusinessOpportunities;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\BusinessOpportunities;

class Data extends Component
{
    public $date_start,$date_end,$keyword,$status;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        $data = BusinessOpportunities::where(['company_id'=>session()->get('company_id'),'employee_id'=>\Auth::user()->employee->id])
                        ->orderBy('id', 'DESC');
        
        if($this->keyword) $data = $data->where(function($table){
            foreach(\Illuminate\Support\Facades\Schema::getColumnListing('business_opportunities') as $column){
                $table->orWhere($column,'LIKE',"%{$this->keyword}%");
            }
        });
        
        if($this->status !="") $data->where('status',$this->status);

        return view('livewire.business-opportunities.data')->with(['data'=>$data->paginate(100)]);
    }
}



