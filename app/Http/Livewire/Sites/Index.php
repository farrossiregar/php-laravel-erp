<?php

namespace App\Http\Livewire\Sites;

use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    
    public $keyword,$region_id;

    protected $listeners = ['refresh-page'=>'$refresh'];

    public function render()
    {
        $data = \App\Models\Site::orderBy('id','DESC');
        if($this->keyword) $data = $data->where(function($table){
                    foreach(\Illuminate\Support\Facades\Schema::getColumnListing('sites') as $column){
                        $table->orWhere($column,'LIKE',"%{$this->keyword}%");
                    }
                });
        if($this->region_id) $data = $data->where('region_id',$this->region_id);
        
        return view('livewire.sites.index')->with(['data'=>$data->paginate(100)]);
    }
}
