<?php

namespace App\Http\Livewire\Employee;

use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    
    protected $listeners = ['emit-delete-hide' => '$refresh'];
    
    public $keyword,$user_access_id,$department_sub_id;
    
    public function render()
    {
        $data = \App\Models\Employee::orderBy('id','DESC');

        if($this->keyword) $data = $data->where(function($table){
            foreach(\Illuminate\Support\Facades\Schema::getColumnListing('employees') as $column){
                $table->orWhere($column,'LIKE',"%{$this->keyword}%");
            }
        });

        if($this->user_access_id) $data = $data->where('user_access_id',$this->user_access_id);

        return view('livewire.employee.index')->with(['data'=>$data->paginate(100)]);
    }
}