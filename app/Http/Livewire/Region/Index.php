<?php

namespace App\Http\Livewire\Region;

use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $keyword;
    protected $listeners = ['emit-insert-hide' => '$refresh','emit-edit-hide' => '$refresh','emit-delete-hide' => '$refresh'];
    public function render()
    {
        $data = \App\Models\Region::orderBy('id','DESC');
        if($this->keyword) $data = $data->where('region','LIKE',"%{$this->keyword}%")->orWhere('region_code','LIKE',"%{$this->keyword}%");

        return view('livewire.region.index')
                    ->with(['data'=>$data->paginate(100)]);
    }
    
}
