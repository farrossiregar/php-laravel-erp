<?php

namespace App\Http\Livewire\Tower;

use Livewire\Component;
use Livewire\WithPagination;
class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $keyword;
    public function render()
    {
        $data = \App\Models\Tower::orderBy('name','ASC');
        if($this->keyword) $data = $data->where('name',"LIKE","%{$this->keyword}%");
        return view('livewire.tower.index')->with(['data'=>$data->paginate(100)]);
    }
}
